<h3>Sidebar</h3>
<ul class="clt">
    <li>
        <a href="{{ route('indexPage') }}">Page</a>
        <ul>
            <li><a href="{{ route('indexPage') }}">Manage</a></li>
            <li><a href="{{ route('createPage') }}">Create</a></li>
        </ul>
    </li>
    <li>
        <a href="{{ route('indexCategory') }}">Category</a>
        <ul>
            <li><a href="{{ route('indexCategory') }}">Manage</a></li>
            <li><a href="{{ route('createCategory') }}">Create</a></li>
        </ul>
    </li>
    <li>
        <a href="{{ route('indexTag') }}">Tag</a>
        <ul>
            <li><a href="{{ route('indexTag') }}">Manage</a></li>
            <li><a href="{{ route('createTag') }}">Create</a></li>
        </ul>
    </li>
    <li>
        <a href="{{ route('indexArticle') }}">Article</a>
        <ul>
            <li><a href="{{ route('indexArticle') }}">Manage</a></li>
            <li><a href="{{ route('createArticle') }}">Create</a></li>
        </ul>
    </li>
    <li>
        <a href="{{ route('indexMenuGroup') }}">Menu Group</a>
        <ul>
            <li><a href="{{ route('indexMenuGroup') }}">Manage</a></li>
            <li><a href="{{ route('createMenuGroup') }}">Create</a></li>
        </ul>
    </li>
</ul>