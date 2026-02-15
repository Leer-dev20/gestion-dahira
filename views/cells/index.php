<?php
// $cells, $members, $totalMembers sont disponibles
?>
<div class="bg-gradient-to-br from-[#1f3b31] to-[#2b5e4a] geometric-pattern py-16 md:py-24">
    <div class="container mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-2 bg-[#d4a843]/20 backdrop-blur-sm text-[#fcf9f2]/90 rounded-full px-4 py-1.5 text-sm mb-6 border border-[#d4a843]/30">
            <span class="w-2 h-2 bg-[#d4a843] rounded-full"></span>
            Organisation Religieuse — Casablanca
        </div>
        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-[#fcf9f2] leading-tight mb-4">
            Dahira Khidmatoul
            <br>
            <span class="text-[#d4a843]">Khadim</span>
        </h1>
        <p class="text-[#fcf9f2]/70 text-lg max-w-xl mx-auto mb-8">
            Plateforme de gestion des membres des cellules de Casablanca
        </p>

        <div class="flex flex-wrap items-center justify-center gap-6 mt-8">
            <div class="bg-[#fcf9f2]/10 backdrop-blur-sm rounded-xl px-6 py-4 border border-[#fcf9f2]/10">
                <div class="flex items-center gap-2 text-[#d4a843] mb-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5h16a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V6a1 1 0 011-1z"/><path d="M8 9h8M8 13h8"/></svg>
                    <span class="font-display text-2xl font-bold"><?= count($cells) ?></span>
                </div>
                <p class="text-sm text-[#fcf9f2]/60">Cellules</p>
            </div>
            <div class="bg-[#fcf9f2]/10 backdrop-blur-sm rounded-xl px-6 py-4 border border-[#fcf9f2]/10">
                <div class="flex items-center gap-2 text-[#d4a843] mb-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span class="font-display text-2xl font-bold"><?= $totalMembers ?></span>
                </div>
                <p class="text-sm text-[#fcf9f2]/60">Membres</p>
            </div>
            <a href="/dahira-gestion/public/cotisations" class="bg-[#fcf9f2]/10 backdrop-blur-sm rounded-xl px-6 py-4 border border-[#fcf9f2]/10 hover:bg-[#fcf9f2]/15 transition-colors">
                <div class="flex items-center gap-2 text-[#d4a843] mb-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="font-display text-2xl font-bold">0 DH</span> <!-- À calculer plus tard -->
                </div>
                <p class="text-sm text-[#fcf9f2]/60">Cotisations</p>
            </a>
        </div>
    </div>
</div>

<section class="container mx-auto px-4 py-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="font-display text-2xl font-bold text-[#1f3b31]">Nos Cellules</h2>
        <a href="/dahira-gestion/public/cellules" class="text-sm text-[#d4a843] hover:underline font-medium">Voir tout →</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach ($cells as $cell): 
            $memberCount = 0;
            foreach ($members as $m) {
                if ($m['cell_id'] == $cell['id']) $memberCount++;
            }
        ?>
        <a href="/dahira-gestion/public/cellule/<?= $cell['id'] ?>" class="group block bg-white rounded-xl border border-[#e2d9cc] p-6 shadow-md hover:shadow-xl transition-all hover:-translate-y-1">
            <div class="flex items-start justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#1f3b31] to-[#2b5e4a] flex items-center justify-center shadow-md">
                    <span class="text-white font-display font-bold text-xl"><?= $cell['id'] ?></span>
                </div>
                <svg class="w-5 h-5 text-[#6b7b6b] group-hover:text-[#d4a843] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
            <h3 class="font-display font-semibold text-[#1f3b31] text-lg mb-1"><?= htmlspecialchars($cell['short_name']) ?></h3>
            <p class="text-sm text-[#6b7b6b] mb-4"><?= htmlspecialchars($cell['description']) ?></p>
            <div class="flex items-center gap-2 text-sm">
                <svg class="w-4 h-4 text-[#d4a843]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span class="font-medium text-[#1f3b31]"><?= $memberCount ?></span>
                <span class="text-[#6b7b6b]">membres</span>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</section>