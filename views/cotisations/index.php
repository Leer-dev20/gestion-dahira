<?php
$months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
$currentYear = date('Y');
?>
<div class="bg-gradient-to-br from-[#1f3b31] to-[#2b5e4a] geometric-pattern py-10">
    <div class="container mx-auto px-4">
        <h1 class="font-display text-3xl font-bold text-[#fcf9f2]">Cotisations Mensuelles</h1>
        <p class="text-[#fcf9f2]/70 mt-1">Suivi des paiements par membre — 100 DH/mois</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-[#e2d9cc] p-4 shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-[#1f3b31]/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#1f3b31]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm text-[#6b7b6b]">Total collecté</p>
                    <p class="font-display text-xl font-bold text-[#1f3b31]"><?= number_format($stats['totalAmount'], 0, ',', ' ') ?> DH</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-[#e2d9cc] p-4 shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-[#d4a843]/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#d4a843]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <div>
                    <p class="text-sm text-[#6b7b6b]">Taux de recouvrement</p>
                    <p class="font-display text-xl font-bold text-[#1f3b31]">
                        <?php
                        $totalExpected = $stats['totalMembers'] * 12;
                        $taux = $totalExpected > 0 ? round($stats['totalPaid'] / $totalExpected * 100) : 0;
                        echo $taux . '%';
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-[#e2d9cc] p-4 shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-[#1f3b31]/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#1f3b31]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm text-[#6b7b6b]">Paiements reçus</p>
                    <p class="font-display text-xl font-bold text-[#1f3b31]"><?= $stats['totalPaid'] ?> / <?= $totalExpected ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-[#e2d9cc] p-4 shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <p class="text-sm text-[#6b7b6b]">Membres en retard</p>
                    <p class="font-display text-xl font-bold text-[#1f3b31]">0</p> <!-- À calculer plus tard -->
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <form method="get" class="flex gap-2">
            <select name="year" class="px-4 py-2 border border-[#e2d9cc] rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-[#d4a843]">
                <?php for ($y = $currentYear - 2; $y <= $currentYear + 1; $y++): ?>
                <option value="<?= $y ?>" <?= $year == $y ? 'selected' : '' ?>><?= $y ?></option>
                <?php endfor; ?>
            </select>
            <select name="cell_id" class="px-4 py-2 border border-[#e2d9cc] rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-[#d4a843]">
                <option value="">Toutes les cellules</option>
                <?php foreach ($cells as $cell): ?>
                <option value="<?= $cell['id'] ?>" <?= $cellId == $cell['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cell['short_name']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="bg-[#1f3b31] text-white px-4 py-2 rounded-lg hover:bg-[#2b5e4a] transition-colors">Filtrer</button>
        </form>
    </div>

    <!-- Tableau des cotisations -->
    <div class="rounded-xl border border-[#e2d9cc] overflow-x-auto">
        <table class="w-full min-w-[800px]">
            <thead class="bg-[#f0ebe3]">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-[#1f3b31] sticky left-0 bg-[#f0ebe3] z-10">Membre</th>
                    <th class="px-4 py-3 text-left font-semibold text-[#1f3b31] sticky left-[160px] bg-[#f0ebe3] z-10">Cellule</th>
                    <?php foreach ($months as $i => $m): ?>
                    <th class="px-4 py-3 text-center font-semibold text-[#1f3b31]"><?= substr($m, 0, 3) ?></th>
                    <?php endforeach; ?>
                    <th class="px-4 py-3 text-center font-semibold text-[#1f3b31]">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): 
                    $cellName = '';
                    foreach ($cells as $c) {
                        if ($c['id'] == $member['cell_id']) {
                            $cellName = $c['short_name'];
                            break;
                        }
                    }
                    $paidCount = 0;
                ?>
                <tr class="border-t border-[#e2d9cc] hover:bg-[#fcf9f2] transition-colors">
                    <td class="px-4 py-3 font-medium sticky left-0 bg-white z-10"><?= htmlspecialchars($member['first_name'] . ' ' . $member['last_name']) ?></td>
                    <td class="px-4 py-3 text-[#6b7b6b] sticky left-[160px] bg-white z-10"><?= htmlspecialchars($cellName) ?></td>
                    <?php for ($mois = 1; $mois <= 12; $mois++): 
                        $cot = isset($cotisationsByMember[$member['id']][$mois]) ? $cotisationsByMember[$member['id']][$mois] : null;
                        $isPaid = $cot && $cot['paid'];
                        if ($isPaid) $paidCount++;
                    ?>
                    <td class="px-2 py-2 text-center">
                        <button class="cotisation-toggle w-10 h-10 rounded-lg flex items-center justify-center mx-auto transition-colors
                            <?= $isPaid ? 'bg-[#1f3b31]/15 text-[#1f3b31] hover:bg-[#1f3b31]/25' : 'bg-red-100 text-red-700/60 hover:bg-red-200' ?>"
                            data-member-id="<?= $member['id'] ?>"
                            data-cell-id="<?= $member['cell_id'] ?>"
                            data-month="<?= $mois ?>"
                            data-year="<?= $year ?>"
                            data-paid="<?= $isPaid ? '1' : '0' ?>">
                            <?php if ($isPaid): ?>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <?php else: ?>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <?php endif; ?>
                        </button>
                    </td>
                    <?php endfor; ?>
                    <td class="px-4 py-3 text-center font-semibold">
                        <span class="<?= $paidCount == 12 ? 'text-[#1f3b31]' : ($paidCount >= 6 ? 'text-[#d4a843]' : 'text-red-600') ?>">
                            <?= $paidCount ?>/12
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
document.querySelectorAll('.cotisation-toggle').forEach(btn => {
    btn.addEventListener('click', function() {
        const memberId = this.dataset.memberId;
        const cellId = this.dataset.cellId;
        const month = this.dataset.month;
        const year = this.dataset.year;
        const currentPaid = this.dataset.paid === '1';

        fetch('/dahira-gestion/public/cotisations/toggle', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ member_id: memberId, cell_id: cellId, month, year })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.dataset.paid = currentPaid ? '0' : '1';
                this.classList.toggle('bg-[#1f3b31]/15');
                this.classList.toggle('text-[#1f3b31]');
                this.classList.toggle('bg-red-100');
                this.classList.toggle('text-red-700/60');
                // Changer l'icône
                const icon = this.querySelector('svg');
                if (icon) {
                    if (currentPaid) {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
                    } else {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>';
                    }
                }
                // Mettre à jour le total de la ligne (optionnel, on peut recalculer)
            }
        });
    });
});
</script>