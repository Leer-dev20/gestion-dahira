<?php
// $member (pour édition) ou null, $cells fournis
$isEdit = isset($member) && $member;
?>
<div class="bg-gradient-to-br from-[#1f3b31] to-[#2b5e4a] geometric-pattern py-10">
    <div class="container mx-auto px-4">
        <h1 class="font-display text-3xl font-bold text-[#fcf9f2]"><?= $isEdit ? 'Modifier le membre' : 'Nouveau membre' ?></h1>
    </div>
</div>

<div class="container mx-auto px-4 py-8 max-w-2xl">
    <form method="post" class="bg-white rounded-xl border border-[#e2d9cc] p-6 shadow-md">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= $member['id'] ?>">
        <?php endif; ?>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-[#1f3b31] mb-1">Prénom *</label>
                <input type="text" name="first_name" required value="<?= $isEdit ? htmlspecialchars($member['first_name']) : '' ?>" class="w-full px-4 py-2 border border-[#e2d9cc] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#d4a843]">
            </div>
            <div>
                <label class="block text-sm font-medium text-[#1f3b31] mb-1">Nom *</label>
                <input type="text" name="last_name" required value="<?= $isEdit ? htmlspecialchars($member['last_name']) : '' ?>" class="w-full px-4 py-2 border border-[#e2d9cc] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#d4a843]">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-[#1f3b31] mb-1">Téléphone</label>
            <input type="text" name="phone" value="<?= $isEdit ? htmlspecialchars($member['phone']) : '' ?>" class="w-full px-4 py-2 border border-[#e2d9cc] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#d4a843]">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-[#1f3b31] mb-1">Email</label>
            <input type="email" name="email" value="<?= $isEdit ? htmlspecialchars($member['email']) : '' ?>" class="w-full px-4 py-2 border border-[#e2d9cc] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#d4a843]">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-[#1f3b31] mb-1">Adresse</label>
            <textarea name="address" rows="2" class="w-full px-4 py-2 border border-[#e2d9cc] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#d4a843]"><?= $isEdit ? htmlspecialchars($member['address']) : '' ?></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-[#1f3b31] mb-1">Cellule *</label>
                <select name="cell_id" required class="w-full px-4 py-2 border border-[#e2d9cc] rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-[#d4a843]">
                    <?php foreach ($cells as $cell): ?>
                    <option value="<?= $cell['id'] ?>" <?= ($isEdit && $member['cell_id'] == $cell['id']) || (isset($_GET['cell_id']) && $_GET['cell_id'] == $cell['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cell['short_name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#1f3b31] mb-1">Statut</label>
                <select name="role" class="w-full px-4 py-2 border border-[#e2d9cc] rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-[#d4a843]">
                    <?php 
                    $roles = ['Dieuwrigne', 'Présidente', 'Secrétaire', 'Trésorier', 'Trésorière', 'Membre'];
                    foreach ($roles as $r):
                    ?>
                    <option value="<?= $r ?>" <?= $isEdit && $member['role'] == $r ? 'selected' : '' ?>><?= $r ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-[#1f3b31] mb-1">Date d'adhésion</label>
            <input type="date" name="join_date" value="<?= $isEdit ? $member['join_date'] : date('Y-m-d') ?>" class="w-full px-4 py-2 border border-[#e2d9cc] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#d4a843]">
        </div>

        <div class="flex justify-end gap-2">
            <a href="/dahira-gestion/public/membres" class="px-4 py-2 border border-[#e2d9cc] rounded-lg text-[#1f3b31] hover:bg-[#f0ebe3] transition-colors">Annuler</a>
            <button type="submit" class="bg-[#1f3b31] text-white px-4 py-2 rounded-lg hover:bg-[#2b5e4a] transition-colors">
                <?= $isEdit ? 'Enregistrer' : 'Ajouter' ?>
            </button>
        </div>
    </form>
</div>