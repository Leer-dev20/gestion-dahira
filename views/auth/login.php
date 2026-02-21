<?php
// views/auth/login.php
$error = $error ?? '';
?>
<div class="min-h-screen flex items-center justify-center bg-[#fcf9f2] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="mx-auto w-20 h-20 rounded-full bg-gradient-to-br from-[#1f3b31] to-[#2b5e4a] flex items-center justify-center shadow-lg">
                <img src="/dahira-gestion/public/logo.png" alt="Dahira" class="h-15 w-auto" />
            </div>
            <h2 class="mt-6 text-center font-display text-3xl font-bold text-[#1f3b31]">
                Connexion
            </h2>
            <p class="mt-2 text-center text-sm text-[#6b7b6b]">
                Accès réservé aux administrateurs
            </p>
        </div>
        <form class="mt-8 space-y-6" method="POST" action="/dahira-gestion/public/login">
            <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="username" class="sr-only">Nom d'utilisateur</label>
                    <input id="username" name="username" type="text" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-[#e2d9cc] placeholder-[#6b7b6b] text-[#1f3b31] rounded-t-md focus:outline-none focus:ring-2 focus:ring-[#d4a843] focus:border-[#d4a843] focus:z-10 sm:text-sm" 
                           placeholder="Nom d'utilisateur">
                </div>
                <div>
                    <label for="password" class="sr-only">Mot de passe</label>
                    <input id="password" name="password" type="password" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-[#e2d9cc] placeholder-[#6b7b6b] text-[#1f3b31] rounded-b-md focus:outline-none focus:ring-2 focus:ring-[#d4a843] focus:border-[#d4a843] focus:z-10 sm:text-sm" 
                           placeholder="Mot de passe">
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#1f3b31] hover:bg-[#2b5e4a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#d4a843]">
                    Se connecter
                </button>
            </div>
        </form>
    </div>
</div>