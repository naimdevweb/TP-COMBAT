// Points de vie initiaux
let heroHp = 100;
let monsterHp = 100;

function attack(attacker) {
    const damage = Math.floor(Math.random() * 20) + 5; // Dégâts aléatoires entre 5 et 25

    if (attacker === 'hero') {
        monsterHp = Math.max(0, monsterHp - damage); // Réduit les PV du monstre
        document.getElementById('monster-health').style.width = monsterHp + '%';
        document.getElementById('monster-hp').textContent = monsterHp;
        if (monsterHp === 0) {
            alert('Le héros a gagné ! 🎉');
        }
    } else if (attacker === 'monster') {
        heroHp = Math.max(0, heroHp - damage); // Réduit les PV du héros
        document.getElementById('hero-health').style.width = heroHp + '%';
        document.getElementById('hero-hp').textContent = heroHp;
        if (heroHp === 0) {
            alert('Le monstre a gagné ! 💀');
        }
    }
}
