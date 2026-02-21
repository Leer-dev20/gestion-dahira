<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dahira Khidmatoul Khadim</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Playfair Display', serif; }
    </style>
    <script>
        // Éventuellement, passer des variables PHP à JS
        const baseUrl = '/dahira-gestion/public'; // À adapter
    </script>
</head>
<body class="bg-[#fcf9f2] text-[#1f3b31]">

<header class="border-b border-[#e2d9cc] bg-white/80 backdrop-blur-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <a href="/dahira-gestion/public/" class="flex items-center gap-3">
        <img src="/dahira-gestion/public/logo.png" alt="Dahira" class="h-10 w-auto" />
        <div class="hidden sm:block">
            <h1 class="font-display font-bold text-foreground text-lg leading-tight">
                Dahira Khidmatoul Khadim
            </h1>
            <p class="text-xs text-muted-foreground">Casablanca</p>
        </div>
        </a>
        <nav class="flex items-center gap-1">
            <a href="/dahira-gestion/public/" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-all hover:bg-[#f0ebe3] <?= ($_SERVER['REQUEST_URI'] == '/dahira-gestion/public/' || $_SERVER['REQUEST_URI'] == '/dahira-gestion/public/index.php') ? 'bg-[#1f3b31] text-white shadow-md' : 'text-[#5a6d5a] hover:text-[#1f3b31]' ?>">
                Accueil
            </a>
            <a href="/dahira-gestion/public/cellules" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-all hover:bg-[#f0ebe3] <?= strpos($_SERVER['REQUEST_URI'], '/cellules') !== false ? 'bg-[#1f3b31] text-white shadow-md' : 'text-[#5a6d5a] hover:text-[#1f3b31]' ?>">
                Cellules
            </a>
            <a href="/dahira-gestion/public/membres" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-all hover:bg-[#f0ebe3] <?= strpos($_SERVER['REQUEST_URI'], '/membres') !== false ? 'bg-[#1f3b31] text-white shadow-md' : 'text-[#5a6d5a] hover:text-[#1f3b31]' ?>">
                Membres
            </a>
            <a href="/dahira-gestion/public/cotisations" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-all hover:bg-[#f0ebe3] <?= strpos($_SERVER['REQUEST_URI'], '/cotisations') !== false ? 'bg-[#1f3b31] text-white shadow-md' : 'text-[#5a6d5a] hover:text-[#1f3b31]' ?>">
                Cotisations
            </a>
        </nav>
        <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLogged = isset($_SESSION['user']);
?>
<header ...>
    <div class="container ...">
        <!-- logo et titre -->
        <nav class="flex items-center gap-1">
            <!-- vos liens existants -->
            <?php if ($isLogged): ?>
                <span class="text-sm text-[#1f3b31] ml-4 bg-[#f0ebe3] px-2 py-1 rounded"><?= htmlspecialchars($_SESSION['user']) ?></span>
                <a href="/dahira-gestion/public/logout" class="ml-2 text-sm text-[#6b7b6b] hover:text-[#1f3b31] bg-[#ff1c1c] px-2 py-1 rounded transition-colors">
                    Déconnexion
                </a>
            <?php endif; ?>
        </nav>
    </div>
</header>
    </div>
</header>

<main class="min-h-screen">