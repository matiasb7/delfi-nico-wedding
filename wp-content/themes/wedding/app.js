class FormFunctions{
    constructor() {
        window.$ = window.jQuery = window.jquery = jQuery
        this.searchName()
        this.uploadData()
        this.continueToRestriction()
    }
    searchName(){
        $("#guest-submit-button").click(function(e) {
            e.preventDefault();
            let guest_name = $("#guest").val();
            if(guest_name){
                $.ajax({
                    method: "GET",
                    url: "/wp-json/search-name-api/search_guest_cpt_by_title/"+guest_name,
                    success: function(data) {
                        const responseDiv = $('.response')

                        if (data.length === 0){
                            $('.fail').remove()
                            let failMessage = '<div class="fail">Oops! We’re having trouble finding your invite. Please try another spelling of your name or contact the couple</div>'
                            $("#guest").after(failMessage)
                        } else {
                            $('.fail').remove()
                            $('#search_guest').addClass('hide-search')
                            responseDiv.append('<div style="margin-bottom: 2rem; font-size:28px;">Select your name from the list below:</div>')
                            data.forEach(function (item){
                                let name = item.name
                                if (item.couple_name !== '') {
                                    name = item.name + ' & ' + item.couple_name
                                }

                                if (item.plus_guests != false) {
                                    name = name + ' & Plus Guest'
                                }

                                responseDiv.append(
                                    `
                                    <div id="guest-${item.id}" data-guest="${item.id}" class="response-item">
                                        <div class="checkbox"></div>
                                        <div class="name-options-to-choose">${name}</div>
                                    </div>
                                    `
                                )
                            })

                            $('.response').after(
                                `<div class="response-buttons">
                                    <button class="form-button form-button-continue ">Continue</button>
                                    <button class="form-button form-button-again ">Search Again</button>
                                </div>`
                            )

                        }

                    },
                    error: function(error) {
                        // console.log(error);
                    }
                });
            }
        });
    }

    continueToRestriction(){
        $(document).on('click', '.form-button-continue', function(e) {
            let item = $('.response-item.active')
            let id = item.attr('data-guest')
            let response = $('.response')
            response.attr('data-id',id)

            $('.response-item').remove()
            $('.response-buttons').remove()

            if (id) {
                let alreadyConfirmed = false;
                $.ajax({
                    method: "GET",
                    url: "/wp-json/check-for-change/check-for-change/" + id ,
                    success: function(data) {
                        console.log(data)
                       if (data == true) {
                           alreadyConfirmed = true
                           $('.rsvp_text').find('h3').after('<div class="alert_message">You have already completed the registration, please contact the couple to change it!</div>')
                           response.remove()
                       }
                    },
                    error : function (data){
                        console.log(data)
                    }
                });
                if (!alreadyConfirmed){
                    $.ajax({
                        method: "GET",
                        url: "/wp-json/search-by-id/search-by-id/" + id ,
                        success: function(item) {
                            let people = [{name: item.name, type: 'main'}]

                            if (item.couple_name != '') {
                                people.push({name : item.couple_name, type : 'couple'})
                            }

                            if (item.plus_guests != false) {
                                people.push({name : 'Plus Guest', type : 'plus_guest'})
                            }

                            people.forEach(function (person){
                                response.append(
                                    `
                                <div class="guest-to-confirm" data-type="${person.type}">
                                    <div class="guest-to-confirm_name">${person.name}</div>
                                    <div class="guest-to-confirm_buttons">
                                        <button class="guest-to-confirm_button guest-to-confirm_accept">Accept</button>
                                        <button class="guest-to-confirm_button guest-to-confirm_decline">Decline</button>
                                    </div>
                                 </div>   
                                `
                                )
                            })

                            response.append(
                                `
                            <textarea rows="8" placeholder="If there is any food restriction, enter here:"></textarea>
                            <button class="confirm-users-wedding form-button">Confirm Selection</button>
                            `
                            )
                        },
                    });
                }

            }
        });
    }

    uploadData(){
        $(document).on('click', '.confirm-users-wedding', function(e) {
            e.preventDefault();
            let container = $(this).parent()
            let guests = container.find('.guest-to-confirm')

            let alert = container.find('.alert_message')
            if (alert){
                alert.remove()
            }

            let nonConfirmed = false;
            let confirmationTypes = {
                'main' : false,
                'couple' : false ,
                'plus_guest' : false
            }
            guests.each(function (){
                let type = $(this).attr('data-type')
                let classes = $(this).attr('class').split(' ');
                console.log(classes)

                if (classes.includes('assist-true')){
                    confirmationTypes[type] = true

                } else if(classes.includes('assist-false')) {
                    confirmationTypes[type] = false

                } else {
                    nonConfirmed = true;
                }
            })

            if (nonConfirmed){
                $('.response').append(
                    '<div class="alert_message">You need to confirm/decline all the guests to continue</div>'
                );
            } else {
                let id =$(this).parent().attr('data-id')
                confirmationTypes.id = id
                confirmationTypes.restriction = $(this).parent().find('textarea').val();

                if(id){
                    $.ajax({
                        method: "POST",
                        contentType: "application/json",
                        dataType: "json",
                        url: "/wp-json/upload-guest-info/upload-guest-restriction/",
                        data: JSON.stringify(confirmationTypes),
                        success: function(data) {
                            console.log(data)
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });

                    $('.response').remove()
                    $('.rsvp_text').append(`
                    <div class="finish-form">Thanks for your confirmation, enjoy!</div>
                     <a href="${location.href.replace('rsvp/', '')}" class="guest-to-confirm_button">Homepage</a>
                    `)
                }
            }
        });
    }

}

new FormFunctions()