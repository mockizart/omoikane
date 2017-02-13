<?php
/**
 * Created by PhpStorm.
 * Email: rifkimuhammad89@gmail.com
 * Website: mockie.net
 * User: mockie
 * Date: 31/01/17
 * Time: 10:36
 */

namespace Omoikane\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Omoikane\Repositories\Contracts\MenuGroupRepository;
use Omoikane\Services\MenuGroup\Contracts\MenuGroupCrud;
use Omoikane\Services\MenuGroup\Contracts\PaginatedMenuGroup;
use Omoikane\Services\MenuMember\Contracts\MenuMemberCrud;
use Omoikane\Services\MenuMember\Contracts\MenuMemberListByGroupId;
use Omoikane\Services\MenuMember\MenuMemberUnorderedListHtml;
use Omoikane\Validations\Contracts\MenuGroupValidation;

class MenuGroupController extends Controller{

    protected $menuGroupRepository;

    protected $menuGroupCrud;

    protected $menuGroupValidation;

    protected $menuMemberCrud;

    protected $paginatedMenuGroup;

    protected $menuMemberListByGroupId;

    public function __construct(
        MenuGroupRepository $menuGroupRepository,
        MenuGroupCrud $menuGroupCrud,
        MenuGroupValidation $menuGroupValidation,
        MenuMemberCrud $menuMemberCrud,
        PaginatedMenuGroup $paginatedMenuGroup,
        MenuMemberListByGroupId $menuMemberListByGroupId
    )
    {
        $this->menuGroupRepository = $menuGroupRepository;
        $this->menuGroupCrud = $menuGroupCrud;
        $this->menuGroupValidation = $menuGroupValidation;
        $this->menuMemberCrud = $menuMemberCrud;
        $this->paginatedMenuGroup = $paginatedMenuGroup;
        $this->menuMemberListByGroupId = $menuMemberListByGroupId;
    }

    protected function menuMemberRecursive($groupId, $checked = [])
    {
        $menuMembers = $this->menuMemberListByGroupId;
        $menuMembers->setGroupId($groupId);
        $menuMembers->setParentId(0);

        $menuMembers = new MenuMemberUnorderedListHtml(
            $menuMembers
        );

        $menuMembers->setAvailableOptions(['edit', 'delete']);
        $menuMembers->setCheckedMenuMember($checked);

        return $menuMembers;
    }

    public function index(Request $request)
    {
        $keyword = $request->input('q');
        $orderBy = $request->input('orderBy', 'created_at');
        $order = $request->input('order', 'desc');

        $data = $this->paginatedMenuGroup->setKeyword($keyword)->setOrderBy($orderBy, $order)->paginatedData();

        $orderForLink = ($order=='desc') ? 'asc' : 'desc';

        $dataToView = [
            'menuGroups' => $data,
            'orderLink' => $orderForLink
        ];

        return view('omoikane::menu_group.index', $dataToView);
    }

    public function create()
    {
        return view('omoikane::menu_group.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->menuGroupValidation->rules);

        $this->menuGroupCrud->create(
            $request->input('name'),
            $request->input('menu-members', [])
        );

        return redirect()->back();
    }

    public function edit($id)
    {
        $menuGroup =  $this->menuGroupRepository->findMenuGroupById($id);

        if (!$menuGroup) {
            abort(404);
        }

        $menuMemberSelectList = $this->menuMemberListByGroupId;
        $menuMemberSelectList->setParentId(0);
        $menuMemberSelectList->setGroupId($menuGroup->id);
        $menuMemberSelect = new \RecursiveIteratorIterator($menuMemberSelectList, \RecursiveIteratorIterator::SELF_FIRST);

        $menuMember = $this->menuMemberRecursive($menuGroup->id, []);

        // to do: populate select with menu
        $dataToView = [
            'menuGroup' => $menuGroup,
            'menuMemberList' => $menuMember,
            'menuMemberSelect' => $menuMemberSelect
        ];

        return view('omoikane::menu_group.edit', $dataToView);
    }

    public function update($id, Request $request)
    {
        $data = $this->menuGroupRepository->findMenuGroupById($id);

        if (!$data) {
            abort(404);
        }

        $this->validate($request, $this->menuGroupValidation->rules);

        $this->menuGroupCrud->update(
            $id,
            $request->input('name'),
            $request->input('menu-members', [])
        );

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->menuGroupCrud->delete($id);

        return redirect()->route('indexMenuGroup');
    }

}