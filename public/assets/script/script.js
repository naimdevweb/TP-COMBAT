let btnHero = document.querySelector('#btn-hero');
let btnRestart = document.querySelector('#btn-restart'); 
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

// Mise à jour de l'attaque du héros
function updateHeroAttackFrom() {
    heroAttack = parseInt(document.querySelector('#attack').textContent, 10);
}

// Mise à jour des barres de santé
function updateHealthBar(healthBar, currentHp, maxHp) {
    const healthPercentage = (currentHp / maxHp) * 100;
    healthBar.style.width = `${healthPercentage}%`;
}

// Fonction d'attaque du héros
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

// Fonction d'attaque du monstre
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

        
        attackMessages.innerHTML += "<p>Vous avez perdu ! Voulez-vous recommencer ?</p>";
        showRestartButton(); 
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

    // Augmenter l'attaque et les points de vie du héros après chaque niveau
    heroHp += 20;
    heroAttack += 5;
    heroHpElement.textContent = heroHp;
    document.querySelector('#attack').textContent = heroAttack;

    updateHealthBar(heroHealthBar, heroHp, heroHp);
}

// Fonction pour afficher le bouton de recommencement
function showRestartButton() {
    btnRestart.style.display = 'block';
}

// Fonction pour cacher le bouton de recommencement
function hideRestartButton() {
    btnRestart.style.display = 'none';
}

// Action lorsque le joueur appuie sur le bouton "Recommencer"
btnRestart.addEventListener('click', function() {
    // Ici vous pouvez réinitialiser les points de vie, le niveau du héros, etc.
    // Réinitialiser les points de vie du héros et du monstre
    heroHp = 100; 
    monsterHp = 100; // Remettre la valeur d'origine du monstre

    heroHpElement.textContent = heroHp;
    monsterHpElement.textContent = monsterHp;
    heroHealthBar.style.width = '100%';
    monsterHealthBar.style.width = '100%';

    attackMessages.innerHTML = ''; // Réinitialiser les messages
    hideRestartButton(); // Masquer le bouton de recommencement

    // Redémarrer le niveau du héros à son niveau initial
    let heroLevelElement = document.querySelector('#hero-level');
    heroLevelElement.textContent = 1; // Remettre le niveau à 1
    document.querySelector('#attack').textContent = 10; // Attaque de base du héros
    increaseHeroLevel(); // Augmenter les stats du héros
    updateHealthBar(heroHealthBar, heroHp, heroHp);
    updateHealthBar(monsterHealthBar, monsterHp, monsterHp);
});

// Action lorsque le joueur appuie sur le bouton "Attaque"
btnHero.addEventListener('click', function () {
    heroAttackAction();
});
function increaseHeroLevel() {
    let heroLevelElement = document.querySelector('#hero-level');
    let currentLevel = parseInt(heroLevelElement.textContent, 10);
    currentLevel += 1;
    heroLevelElement.textContent = currentLevel;

    // Augmenter l'attaque et les points de vie du héros après chaque niveau
    heroHp += 20;
    heroAttack += 5;
    heroHpElement.textContent = heroHp;
    document.querySelector('#attack').textContent = heroAttack;

    // Sauvegarder les nouvelles valeurs dans la base de données
    saveHeroStats(currentLevel, heroHp, heroAttack);
    
    updateHealthBar(heroHealthBar, heroHp, heroHp);
}

// Fonction pour envoyer les nouvelles statistiques du héros à PHP
function saveHeroStats(level, hp, attack) {
    let heroId = document.querySelector('#hero-id') ? document.querySelector('#hero-id').textContent : null;
    let heroLevel = document.querySelector('#hero-level') ? document.querySelector('#hero-level').textContent : null;
    let heroHp = document.querySelector('#hero-hp') ? document.querySelector('#hero-hp').textContent : null;
    let heroAttack = document.querySelector('#attack') ? document.querySelector('#attack').textContent : null;

    // Affichage des données pour débogage
    console.log('heroId:', heroId);
    console.log('heroLevel:', heroLevel);
    console.log('heroHp:', heroHp);
    console.log('heroAttack:', heroAttack);

    // Assurez-vous que toutes les valeurs nécessaires sont présentes
    if (!heroId || !heroLevel || !heroHp || !heroAttack) {
        console.error('Données manquantes pour le héros.');
        return;
    }

    // Création de l'objet de données à envoyer
    const heroStats = {
        heroId: heroId,
        newLevel: level,
        newHp: hp,
        newAttack: attack
    };

    // Affichage des données envoyées
    console.log('Données envoyées :', heroStats);

    // Envoi de la requête AJAX
    function saveHeroStats(level, hp, attack) {
        let heroId = document.querySelector('#hero-id') ? document.querySelector('#hero-id').textContent : null;
    
        if (!heroId || !level || !hp || !attack) {
            console.error('Données manquantes pour le héros.');
            return;
        }
    
        const heroStats = {
            heroId: heroId,
            newLevel: level,
            newHp: hp,
            newAttack: attack
        };
    
        fetch('../src/Entities/HeroStats.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(heroStats)
        })
        .then(response => {
            console.log('Réponse brute du serveur:', response);
            
            // Vérification de la réponse du serveur
            if (!response.ok) {
                throw new Error('Erreur serveur : ' + response.statusText);
            }
            
            return response.text(); // Utilise .text() pour loguer la réponse brute
        })
        .then(text => {
            console.log('Réponse brute (texte):', text);
            try {
                const data = JSON.parse(text);  // Essaye de parser la réponse en JSON
                console.log('Réponse du serveur:', data);
                if (data.success) {
                    console.log('Héros mis à jour avec succès.');
                    document.getElementById('hero-level').textContent = data.newLevel;
                    document.getElementById('hero-hp').textContent = data.newHp;
                    document.getElementById('attack').textContent = data.newAttack;
                } else {
                    console.error('Erreur lors de la mise à jour du héros:', data.message);
                }
            } catch (error) {
                console.error('Erreur de parsing JSON:', error);
            }
        })
        .catch(error => {
            console.error('Erreur de communication avec le serveur:', error);
        });
    }
}

