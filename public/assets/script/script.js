let btnHero = document.querySelector('#btn-hero');
let heroHpElement = document.querySelector('#hero-hp');
let monsterHpElement = document.querySelector('#monster-hp');
let heroHealthBar = document.querySelector('#hero-health');
let monsterHealthBar = document.querySelector('#monster-health');
let attackMessages = document.querySelector('#attack-messages');

let heroHp = parseInt(heroHpElement.textContent, 10);
let monsterHp = parseInt(monsterHpElement.textContent, 10);
let heroAttack = parseInt(document.querySelector('#attack').textContent, 10);
let monsterAttack = parseInt(document.querySelector('#monstre-attack').textContent, 10);

heroHpElement.textContent = heroHp;
monsterHpElement.textContent = monsterHp;

function updateHeroAttackFrom() {
    heroAttack = parseInt(document.querySelector('#attack').textContent, 10);
}

function updateHealthBar(healthBar, currentHp, maxHp) {
    const healthPercentage = (currentHp / maxHp) * 100;
    healthBar.style.width = `${healthPercentage}%`;
}

function heroAttackAction() {
    updateHeroAttackFrom();

    let heroName = document.querySelector('.character.hero h2').textContent;

    // Vérifier si le monstre est déjà mort
    if (monsterHp <= 0) {
        attackMessages.innerHTML = "<p>Le monstre est déjà mort !</p>";
        return;
    }

    let attacks = [
        "attaque avec une épée et inflige",
        "lance une flèche et inflige",
        "frappe avec son bouclier et inflige",
        "utilise une magie dévastatrice et inflige"
    ];

    function getRandomAttack() {
        let randomIndex = Math.floor(Math.random() * attacks.length);
        return attacks[randomIndex];
    }

    // Attaque du héros
    monsterHp -= heroAttack;

    let attackMessage = getRandomAttack();
    let heroMessage = `${heroName} ${attackMessage} ${heroAttack} dégâts !`;

    attackMessages.innerHTML = `<p>${heroMessage}</p>`;

    if (monsterHp <= 0) {
        monsterHp = 0;
        monsterHpElement.textContent = monsterHp;
        alert("Le monstre est vaincu !");
        updateHealthBar(monsterHealthBar, monsterHp, 100);

        // Augmenter le niveau du héros
        increaseHeroLevel();
        return;
    }

    monsterHpElement.textContent = monsterHp;
    updateHealthBar(monsterHealthBar, monsterHp, 100); 
    console.log('Héros attaque ! HP du monstre :', monsterHp);

    // Délai avant que le monstre contre-attaque
    setTimeout(monsterAttackAction, 2000);
}

function monsterAttackAction() {
    let monsterName = document.querySelector('.character.monster h2').textContent;

    heroHp -= monsterAttack;

    let monsterMessage = `${monsterName} contre-attaque et inflige ${monsterAttack} dégâts !`;
    attackMessages.innerHTML += `<p>${monsterMessage}</p>`;

    if (heroHp <= 0) {
        heroHp = 0;
        heroHpElement.textContent = heroHp;
        alert("Le héros est vaincu !");
        updateHealthBar(heroHealthBar, heroHp, 50); 
        return;
    }

    heroHpElement.textContent = heroHp;
    updateHealthBar(heroHealthBar, heroHp, 100); 
    console.log('Monstre attaque ! HP du héros :', heroHp);
}

// Fonction pour augmenter le niveau du héros
function increaseHeroLevel() {
    
    let heroLevelElement = document.querySelector('#hero-level');
    let currentLevel = parseInt(heroLevelElement.textContent, 10);
    currentLevel += 1; 
    heroLevelElement.textContent = currentLevel; 

    
}

btnHero.addEventListener('click', function () {
    heroAttackAction();
});
