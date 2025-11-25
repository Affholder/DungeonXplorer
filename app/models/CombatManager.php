<?php
//toutes les regles de base de calcul des combats.
class CombatManager{

    public function calculateInitiative($combatant) {
        return rand(1, 6) + $combatant->initiative;
    }

    private function calculateDefenseBonus($defender) {
        if ($defender->class_id == 2) { 
            return (int)($defender->initiative / 2);
        } else {
            return (int)($defender->strength / 2);
        }
    }

    public function calculatePhysicalAttack($attacker, $weaponBonus) {
        return rand(1, 6) + $attacker->strength + $weaponBonus;
    }

    public function calculateMagicAttack($spellCost) {
        return (rand(1, 6) + rand(1, 6)) + $spellCost;
    }

    public function calculateDefense($defender, $armorBonus) {
        $defenseBase = $this->calculateDefenseBonus($defender);
        return rand(1, 6) + $defenseBase + $armorBonus;
    }

    public function applyDamage($attackValue, $defenseValue) {
        return max(0, $attackValue - $defenseValue);
    }
}

?>