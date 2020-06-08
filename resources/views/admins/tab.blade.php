<ul class="nav nav-tabs nav-justified mb-3">
    {{-- ユーザ詳細タブ --}}
    <li class="nav-item">
        <a href="{{ route('index') }}" class="nav-link {{ Request::routeIs('index') ? 'active' : '' }}">
            ユーザー登録
        </a>
    </li>
    {{-- フォロー一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route('change_department_page') }}" class="nav-link {{ Request::routeIs('change_department_page') ? 'active' : '' }}">
            部署変更
        </a>
    </li>
</ul>