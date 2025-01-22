document.addEventListener('DOMContentLoaded', () => {
    const btnHero = document.querySelector('#btn-hero');
    const btnRestart = document.querySelector('#btn-restart');
    const btnQuit = document.querySelector('#btn-quit');
    const btnrestaurer = document.querySelector('#btn-restaure');
    const heroHpElement = document.querySelector('#hero-hp');
    const monsterHpElement = document.querySelector('#monster-hp');
    const heroHealthBar = document.querySelector('#hero-health');
    const monsterHealthBar = document.querySelector('#monster-health');
    const attackMessages = document.querySelector('#attack-messages');
    const updateStatsForm = document.querySelector('#update-stats-form');
    const attackSound = new Audio('./assets/coup_ventre.mp3');
    const backgroundMusic = new Audio('./assets/epic-music-fight-battle-airforce-navy-combat-background-intro-theme-259695.mp3'); 

    backgroundMusic.loop = true; 
    backgroundMusic.volume = 0.5; 

    
    function startBackgroundMusic() {
        backgroundMusic.play().catch((error) => {
            console.error('Erreur lors de la lecture de la musique de fond :', error);
        });
    }

    
    function stopBackgroundMusic() {
        backgroundMusic.pause();
        backgroundMusic.currentTime = 0; 
    }

    
    const heroId = document.querySelector('#hero-id').value;
    let heroHp = parseInt(heroHpElement.textContent, 10);
    let monsterHp = parseInt(monsterHpElement.textContent, 10);
    const heroAttack = parseInt(document.querySelector('#attack').textContent, 10);
    const monsterAttack = parseInt(document.querySelector('#monstre-attack').textContent, 10);
    const maxHeroHp = heroHp;
    const maxMonsterHp = monsterHp;

    // Met à jour la barre de santé
    function updateHealthBar(healthBar, currentHp, maxHp) {
        healthBar.style.width = `${(currentHp / maxHp) * 100}%`;
    }

    // Fonction pour gérer l'attaque du héros
    function heroAttackAction() {
        if (monsterHp <= 0) {
            attackMessages.innerHTML = "<p>Le monstre est déjà vaincu !</p>";
            return;
        }

        const hero = document.querySelector('.hero');
        const monster = document.querySelector('.monster');
        hero.classList.add('attacking');

        attackSound.currentTime = 0; // Réinitialise le son d'attaque
        attackSound.play(); // Joue le son d'attaque

        attackMessages.innerHTML = `<p>Le héros attaque et inflige ${heroAttack} dégâts !</p>`;
        monsterHp -= heroAttack;

        if (monsterHp <= 0) {
            monsterHp = 0;
            attackMessages.innerHTML += "<p>Le monstre est vaincu !</p>";
            alert("Le monstre est vaincu !");
            updateStatsForm.submit();
        }

        monsterHpElement.textContent = monsterHp;
        updateHealthBar(monsterHealthBar, monsterHp, maxMonsterHp);

        monster.classList.add('shaking');
        setTimeout(() => {
            hero.classList.remove('attacking');
            monster.classList.remove('shaking');
        }, 500);

        if (monsterHp > 0) {
            setTimeout(() => {
                monsterAttackAction();
            }, 1000);
        }
    }

    // Gérer l'attaque avec la touche "Espace" ou un clic
    document.addEventListener('keydown', (event) => {
        if (event.code === 'Space') {
            event.preventDefault();
            heroAttackAction();
        }
    });

    const attackButton = document.getElementById('attack-btn');
    if (attackButton) {
        attackButton.addEventListener('click', heroAttackAction);
    }

    // Fonction pour gérer l'attaque du monstre
    function monsterAttackAction() {
        if (heroHp <= 0) {
            attackMessages.innerHTML += "<p>Le héros est déjà vaincu !</p>";
            return;
        }

        const hero = document.querySelector('.hero');
        const monster = document.querySelector('.monster');
        monster.classList.add('attacking');

        attackMessages.innerHTML += `<p>Le monstre contre-attaque et inflige ${monsterAttack} dégâts !</p>`;
        heroHp -= monsterAttack;

        if (heroHp <= 0) {
            heroHp = 0;
            attackMessages.innerHTML += "<p>Le héros est vaincu !</p>";
            alert("Le héros est vaincu !");
            btnrestaurer.style.display = "none";
            btnHero.style.display = "none";
            hero.classList.remove('shaking', 'attacking');
            endGame();
        }

        heroHpElement.textContent = heroHp;
        updateHealthBar(heroHealthBar, heroHp, maxHeroHp);

        hero.classList.add('shaking');
        setTimeout(() => {
            monster.classList.remove('attacking');
            hero.classList.remove('shaking');
        }, 500);

        if (heroHp <= 50 && heroHp > 0) {
            btnrestaurer.style.display = "inline-block";
        } else {
            btnrestaurer.style.display = "none";
        }
    }

    // Restaurer la santé du héros
    btnrestaurer.addEventListener('click', () => {
        if (heroHp > 0 && heroHp <= 50) {
            heroHp += 30;
            if (heroHp > maxHeroHp) heroHp = maxHeroHp;
            heroHpElement.textContent = heroHp;
            updateHealthBar(heroHealthBar, heroHp, maxHeroHp);
            btnrestaurer.style.display = "none";
        }
    });

    // Commencer le combat avec la musique
    function startCombat() {
        startBackgroundMusic(); 
        console.log("Le combat commence !");
    }

    // Fin du combat
    function endGame() {
        btnRestart.style.display = "inline-block";
        btnQuit.style.display = "inline-block";
        stopBackgroundMusic(); 
    }

    // Redémarrer le jeu
    function restartGame() {
        location.reload();
    }

    // Quitter le jeu
    function quitGame() {
        if (confirm("Êtes-vous sûr de vouloir quitter ? Votre héros sera supprimé de la base de données.")) {
            window.location.href = "../process/process_endGame.php";
        }
    }

    // Ajouter les gestionnaires d'événements
    btnHero.addEventListener('click', heroAttackAction);
    btnRestart.addEventListener('click', restartGame);
    btnQuit.addEventListener('click', quitGame);

    // Démarrer le combat
    startCombat();
});
