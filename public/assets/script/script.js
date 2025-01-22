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
    const attackSound = new Audio('https://s3-us-west-2.amazonaws.com/s.cdpn.io/1159990/clap.wav');

    // Récupérer l'ID du héros depuis l'élément caché
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

    // Ajouter la classe d'attaque du héros
    const hero = document.querySelector('.hero');
    const monster = document.querySelector('.monster');
    hero.classList.add('attacking');

    // Jouer le son de l'attaque
    attackSound.currentTime = 0; 
    attackSound.play();

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

    // Ajouter des animations
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

// Ajouter l'événement pour le clic sur un bouton ou la touche "Espace"
document.addEventListener('keydown', (event) => {
    if (event.code === 'Space') { // Vérifie si la touche "Espace" est pressée
        event.preventDefault(); // Empêche le défilement de la page
        heroAttackAction();
    }
});

// Ajout d'un événement au clic 
const attackButton = document.getElementById('attack-btn');
if (attackButton) {
    attackButton.addEventListener('click', heroAttackAction);
}




    
    function monsterAttackAction() {
        if (heroHp <= 0) {
            attackMessages.innerHTML += "<p>Le héros est déjà vaincu !</p>";
            return;
        }
    
        // Ajouter la classe d'attaque du monstre
        const hero = document.querySelector('.hero');
        const monster = document.querySelector('.monster');
        monster.classList.add('attacking');
    
        attackMessages.innerHTML += `<p>Le monstre contre-attaque et inflige ${monsterAttack} dégâts !</p>`;
        heroHp -= monsterAttack;
    
        // Vérifier si le héros est vaincu
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
    
   
    btnrestaurer.addEventListener('click', () => {
        if (heroHp > 0 && heroHp <= 50) {
            heroHp += 30; 
            if (heroHp > 50) heroHp = 50; 
            heroHpElement.textContent = heroHp;
            updateHealthBar(heroHealthBar, heroHp, maxHeroHp);
            btnrestaurer.style.display = "none"; 
        }
    
        
        if (heroHp > 50) {
            btnrestaurer.style.display = "none";
        }
    });
    
    
    

   

    // Fin du combat
    function endGame() {
        btnRestart.style.display = "inline-block";
        btnQuit.style.display = "inline-block";
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

   
    

    
    btnHero.addEventListener('click', heroAttackAction);
    btnRestart.addEventListener('click', restartGame);
    btnQuit.addEventListener('click', quitGame);
    
});
