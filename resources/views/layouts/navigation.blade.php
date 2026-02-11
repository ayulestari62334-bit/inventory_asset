<nav style="background:#111827; padding:10px;">
    <div style="display:flex; gap:15px; align-items:center;">
        <a href="/" style="color:white; font-weight:bold; text-decoration:none;">
            Inventory Asset
        </a>

        <a href="/users" style="color:white; text-decoration:none;">
            Users
        </a>

        <form action="{{ route('logout') }}" method="POST" style="margin-left:auto;">
            @csrf
            <button type="submit"
                style="background:#dc2626;color:white;border:none;padding:6px 12px;cursor:pointer;">
                Logout
            </button>
        </form>
    </div>
</nav>
