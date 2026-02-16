<?php
// $members, $cells fournis par MemberController->index()
// On peut ajouter une logique de filtre côté serveur via GET
$search = isset($_GET['search']) ? $_GET['search'] : '';
$cellFilter = isset($_GET['cell_id']) ? $_GET['cell_id'] : '';
?>
<div class="bg-gradient-to-br from-[#1f3b31] to-[#2b5e4a] geometric-pattern py-10">
    <div class="container mx-auto px-4">
        <h1 class="font-display text-3xl font-bold text-[#fcf9f2]">Tous les Membres</h1>
        <p class="text-[#fcf9f2]/70 mt-1"><?= count($members) ?> membres dans l'ensemble des cellules</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <form method="get" class="flex-1 flex gap-2">
            <input type="text" name="search" placeholder="Rechercher un membre..." value="<?= htmlspecialchars($search) ?>" class="flex-1 px-4 py-2 border border-[#e2d9cc] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#d4a843]">
            <select name="cell_id" class="px-4 py-2 border border-[#e2d9cc] rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-[#d4a843]">
                <option value="">Toutes les cellules</option>
                <?php foreach ($cells as $cell): ?>
                <option value="<?= $cell['id'] ?>" <?= $cellFilter == $cell['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cell['short_name']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="bg-[#1f3b31] text-white px-4 py-2 rounded-lg hover:bg-[#2b5e4a] transition-colors">Filtrer</button>
        </form>
        <a href="/dahira-gestion/public/membre/ajouter" class="bg-[#d4a843] text-[#1f3b31] px-4 py-2 rounded-lg hover:bg-[#c49a33] transition-colors shadow-md flex items-center gap-2 justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Ajouter
        </a>
    </div>

    <?php
    // Filtrer côté serveur (on peut le faire dans le contrôleur, mais ici pour l'exemple)
    $filtered = array_filter($members, function($m) use ($search, $cellFilter) {
        if ($cellFilter !== '' && $m['cell_id'] != $cellFilter) return false;
        if ($search !== '') {
            $fullName = $m['first_name'] . ' ' . $m['last_name'] . ' ' . $m['phone'];
            if (stripos($fullName, $search) === false) return false;
        }
        return true;
    });
    ?>

    <?php if (empty($filtered)): ?>
        <div class="text-center py-12 text-[#6b7b6b]">
            <p class="font-display text-lg">Aucun membre trouvé</p>
            <p class="text-sm mt-1">Modifiez vos critères de recherche</p>
        </div>
    <?php else: ?>
        <div class="rounded-xl border border-[#e2d9cc] overflow-hidden">
            <table class="w-full">
                <thead class="bg-[#f0ebe3]">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-[#1f3b31]">Nom complet</th>
                        <th class="px-4 py-3 text-left font-semibold text-[#1f3b31]">Cellule</th>
                        <th class="px-4 py-3 text-left font-semibold text-[#1f3b31]">Téléphone</th>
                        <th class="px-4 py-3 text-left font-semibold text-[#1f3b31] hidden md:table-cell">Email</th>
                        <th class="px-4 py-3 text-left font-semibold text-[#1f3b31]">Statut</th>
                        <th class="px-4 py-3 text-right font-semibold text-[#1f3b31]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($filtered as $member): ?>
                    <tr class="border-t border-[#e2d9cc] hover:bg-[#fcf9f2] transition-colors">
                        <td class="px-4 py-3 font-medium"><?= htmlspecialchars($member['first_name'] . ' ' . $member['last_name']) ?></td>
                        <td class="px-4 py-3 text-[#6b7b6b]"><?= htmlspecialchars($member['cell_name'] ?? '') ?></td>
                        <td class="px-4 py-3 text-[#6b7b6b]"><?= htmlspecialchars($member['phone']) ?></td>
                        <td class="px-4 py-3 text-[#6b7b6b] hidden md:table-cell"><?= htmlspecialchars($member['email']) ?: '—' ?></td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 rounded-full text-xs font-medium 
                                <?php
                                $role = strtolower($member['role']);
                                if ($role === 'Dieuwrigne' || $role === 'présidente') echo 'bg-[#1f3b31] text-white';
                                elseif ($role === 'secrétaire') echo 'bg-[#d4a843] text-[#1f3b31]';
                                elseif ($role === 'trésorier' || $role === 'trésorière') echo 'bg-[#2b5e4a] text-white';
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