<?php
// $cells est fourni par CellController->list()
// $members est fourni pour compter les membres par cellule (optionnel)
?>
<div class="bg-gradient-to-br from-[#1f3b31] to-[#2b5e4a] geometric-pattern py-10">
    <div class="container mx-auto px-4">
        <h1 class="font-display text-3xl font-bold text-[#fcf9f2]">Les Cellules</h1>
        <p class="text-[#fcf9f2]/70 mt-1">Gérez les trois cellules de la Dahira</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach ($cells as $cell): 
            // Compter les membres de cette cellule (si $members est disponible)
            $memberCount = 0;
            if (isset($members)) {
                foreach ($members as $m) {
                    if ($m['cell_id'] == $cell['id']) $memberCount++;
                }
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
</div>