<?php
// $cell, $members fournis par CellController->show()
?>
<div class="bg-gradient-to-br from-[#1f3b31] to-[#2b5e4a] geometric-pattern py-10">
    <div class="container mx-auto px-4">
        <a href="/dahira-gestion/public/cellules" class="inline-flex items-center gap-1 text-[#fcf9f2]/70 hover:text-[#fcf9f2] text-sm mb-4 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Retour aux cellules
        </a>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="font-display text-3xl font-bold text-[#fcf9f2]"><?= htmlspecialchars($cell['name']) ?></h1>
                <p class="text-[#fcf9f2]/70 mt-1"><?= htmlspecialchars($cell['description']) ?></p>
                <div class="flex items-center gap-2 mt-3">
                    <svg class="w-4 h-4 text-[#d4a843]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span class="text-[#fcf9f2] font-medium"><?= count($members) ?> membres</span>
                </div>
            </div>
            <a href="/dahira-gestion/public/membre/ajouter?cell_id=<?= $cell['id'] ?>" class="bg-[#d4a843] text-[#1f3b31] px-4 py-2 rounded-lg hover:bg-[#c49a33] transition-colors shadow-md flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                Ajouter un membre
            </a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <?php if (empty($members)): ?>
        <div class="text-center py-12 text-[#6b7b6b]">
            <p class="font-display text-lg">Aucun membre dans cette cellule</p>
            <p class="text-sm mt-1">Ajoutez un nouveau membre pour commencer</p>
        </div>
    <?php else: ?>
        <div class="rounded-xl border border-[#e2d9cc] overflow-hidden">
            <table class="w-full">
                <thead class="bg-[#f0ebe3]">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-[#1f3b31]">Nom complet</th>
                        <th class="px-4 py-3 text-left font-semibold text-[#1f3b31]">Téléphone</th>
                        <th class="px-4 py-3 text-left font-semibold text-[#1f3b31] hidden md:table-cell">Email</th>
                        <th class="px-4 py-3 text-left font-semibold text-[#1f3b31] hidden lg:table-cell">Adresse</th>
                        <th class="px-4 py-3 text-left font-semibold text-[#1f3b31]">Statut</th>
                        <th class="px-4 py-3 text-right font-semibold text-[#1f3b31]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($members as $member): ?>
                    <tr class="border-t border-[#e2d9cc] hover:bg-[#fcf9f2] transition-colors">
                        <td class="px-4 py-3 font-medium"><?= htmlspecialchars($member['first_name'] . ' ' . $member['last_name']) ?></td>
                        <td class="px-4 py-3 text-[#6b7b6b]"><?= htmlspecialchars($member['phone']) ?></td>
                        <td class="px-4 py-3 text-[#6b7b6b] hidden md:table-cell"><?= htmlspecialchars($member['email']) ?: '—' ?></td>
                        <td class="px-4 py-3 text-[#6b7b6b] hidden lg:table-cell"><?= htmlspecialchars($member['address']) ?></td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 rounded-full text-xs font-medium 
                                <?php
                                $role = strtolower($member['role']);
                                if ($role === 'Dieuwrine' || $role === 'Dwr-commission') echo 'bg-[#1f3b31] text-white';
                                elseif ($role === 'Secrétaire') echo 'bg-[#d4a843] text-[#1f3b31]';
                                elseif ($role === 'Finance') echo 'bg-[#2b5e4a] text-[#1f3b31]';
                                elseif ($role === 'Culturelle') echo 'bg-[#8b4513] text-white';
                                elseif ($role === 'Organisation') echo 'bg-[#4b0082] text-white';
                                elseif ($role === 'Communication') echo 'bg-[#c49a33] text-[#1f3b31]';
                                else echo 'bg-[#f0ebe3] text-[#5a6d5a]';
                                ?>">
                                <?= htmlspecialchars($member['role']) ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="/dahira-gestion/public/membre/modifier/<?= $member['id'] ?>" class="inline-block p-1 text-[#6b7b6b] hover:text-[#1f3b31] transition-colors" title="Modifier">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <a href="/dahira-gestion/public/membre/supprimer/<?= $member['id'] ?>" class="inline-block p-1 text-[#6b7b6b] hover:text-red-600 transition-colors" title="Supprimer" onclick="return confirm('Confirmer la suppression ?')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>