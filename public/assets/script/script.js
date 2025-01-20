document.addEventListener('DOMContentLoaded', () => {
    const btnHero = document.querySelector('#btn-hero');
    const btnRestart = document.querySelector('#btn-restart');
    const btnQuit = document.querySelector('#btn-quit');
    const heroHpElement = document.querySelector('#hero-hp');
    const monsterHpElement = document.querySelector('#monster-hp');
    const heroHealthBar = document.querySelector('#hero-health');
    const monsterHealthBar = document.querySelector('#monster-health');
    const attackMessages = document.querySelector('#attack-messages');
    const updateStatsForm = document.querySelector('#update-stats-form'); 

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

    // Action de l'attaque du héros
    function heroAttackAction() {
        if (monsterHp <= 0) {
            attackMessages.innerHTML = "<p>Le monstre est déjà vaincu !</p>";
            return;
        }

        attackMessages.innerHTML = `<p>Le héros attaque et inflige ${heroAttack} dégâts !</p>`;
        monsterHp -= heroAttack;

        if (monsterHp <= 0) {
            monsterHp = 0;
            attackMessages.innerHTML += "<p>Le monstre est vaincu !</p>";
            alert("Le monstre est vaincu !");
            endGame();
            updateStatsForm.submit(); 
        }

        monsterHpElement.textContent = monsterHp;
        updateHealthBar(monsterHealthBar, monsterHp, maxMonsterHp);

        if (monsterHp > 0) {
            setTimeout(monsterAttackAction, 2000); 
        }
    }

    // Action de l'attaque du monstre
    function monsterAttackAction() {
        if (heroHp <= 0) {
            attackMessages.innerHTML += "<p>Le héros est déjà vaincu !</p>";
            return;
        }

        attackMessages.innerHTML += `<p>Le monstre contre-attaque et inflige ${monsterAttack} dégâts !</p>`;
        heroHp -= monsterAttack;

        if (heroHp <= 0) {
            heroHp = 0;
            attackMessages.innerHTML += "<p>Le héros est vaincu !</p>";
            alert("Le héros est vaincu !");
            endGame(); 
        }

        heroHpElement.textContent = heroHp;
        updateHealthBar(heroHealthBar, heroHp, maxHeroHp);
    }

    
    function endGame() {
        btnRestart.style.display = "inline-block";
        btnQuit.style.display = "inline-block";
    }

    
    function restartGame() {
        location.reload(); 
    }

   
    function quitGame() {
      
        if (confirm("Êtes-vous sûr de vouloir quitter ? Votre héros sera supprimé de la base de données.")) {
           
            window.location.href = "../process/process_endGame.php";  
        }
    }

    
    btnHero.addEventListener('click', heroAttackAction);
    btnRestart.addEventListener('click', restartGame);
    btnQuit.addEventListener('click', quitGame);

});
