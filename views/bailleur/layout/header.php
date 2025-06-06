<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="<?= ASSET_PATH ?>css/bailleur.css">
<script src="<?= ASSET_PATH ?>js/main.js"></script>
<!-- Header principal du bailleur -->
<header class="w-full bg-blue-700 text-white flex items-center justify-between px-6 py-4 shadow">
    <div class="flex items-center gap-3">
        <button id="sidebarToggle" class="md:hidden focus:outline-none mr-2">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <img src="/assets/images/flavicon.png" alt="Logo" class="w-9 h-9 rounded" />
        <span class="text-2xl font-bold">Espace Bailleur</span>
    </div>
    <div class="flex items-center gap-2">
        <a href="/bailleur/profile" class="flex items-center gap-1 hover:underline">
            <span class="inline-block bg-white text-blue-700 rounded-full p-1">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 10a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/></svg>
            </span>
            <span class="font-semibold">Mon profil</span>
        </a>
        <a href="/bailleur/logout" class="ml-4 px-3 py-1 rounded bg-red-600 text-white font-semibold hover:bg-red-700">Déconnexion</a>
    </div>
</header>
<!-- Sidebar et contenu -->
<div class="flex min-h-screen">
    <aside class="w-64 bg-blue-700 text-white p-6 space-y-6 hidden md:block" id="sidebar">
        <?php require_once VIEW_PATH . 'bailleur/layout/navbar.php'; ?>
    </aside>