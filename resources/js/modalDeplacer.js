document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner tous les boutons "Déplacer"
    const deplacerButtons = document.querySelectorAll('.btn-deplacer');
    
    // Sélectionner la fenêtre modale
    const modal = document.getElementById('modal-deplacer');
    
    // Ajouter un événement d'écouteur de clic à chaque bouton "Deplacer"
    deplacerButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            // Empêcher le comportement par défaut du lien (qui est de naviguer vers une nouvelle page)
            event.preventDefault();
    
            // Ouvrir la fenêtre modale
            modal.showModal();
        });
    });
    
    // Sélectionner le bouton "annuler" dans la fenêtre modale
    const closeModalButton = document.querySelector('.btn-modal-cancel');
    
    // Ajouter un événement d'écouteur de clic au bouton "annuler"
    closeModalButton.addEventListener('click', function(event) {
        // Empêcher le comportement par défaut du bouton (qui est de soumettre le formulaire)
        event.preventDefault();
    
        // Fermer la fenêtre modale
        modal.close();
    });
    
    // Fermer la fenêtre modale lorsque l'utilisateur clique en dehors de celle-ci
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.close();
        }
    });
});