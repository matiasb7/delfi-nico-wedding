class FormAnimations {
    constructor() {
        window.$ = window.jQuery = window.jquery = jQuery
        this.checkboxAnimations()
        this.confirmAssistance()
        this.finishConfirmation()
        this.searchAgain()
    }

    searchAgain(){
        $(document).on('click', '.form-button-again', function(e) {
            location.reload()
        });

    }

    checkboxAnimations(){
        $(document).on('click', '.checkbox', function(e) {
            $('.response-item').removeClass('active')
            $(this).parent().addClass('active')
        });

        $(document).on('click', '.name-options-to-choose', function(e) {
            $('.response-item').removeClass('active')
            $(this).parent().addClass('active')
        });
    }

    confirmAssistance(){
        $(document).on('click', '.guest-to-confirm_button', function(e) {

            let classToAdd = '';
            if ($(this).hasClass('guest-to-confirm_accept')) {
                classToAdd = 'assist-true'

            } else if($(this).hasClass('guest-to-confirm_decline')) {
                classToAdd = 'assist-false'
            }

            let parentContainer = $(this).parent().parent()
            parentContainer.removeClass('assist-true assist-false')

            parentContainer.addClass(classToAdd)

        });
    }

    finishConfirmation(){
        $(document).on('click', '.confirm-users-wedding', function(e) {

        })
    }

}

new FormAnimations()