class HeaderMenu {
    constructor() {
        window.$ = window.jQuery = window.jquery = jQuery
/*
        $(window).load(function () {
            if ($('#wpadminbar')[0]){
                $('.header').css('top', $('header').css('top') + $('#wpadminbar').height())
            }
        });
*/
        this.handleHeader()
    }
    handleHeader() {
        const menuItems = $('.menu-item')
        const mobileContainer = $('.mobile-menu-select')
        const iconsTabsContainer = $('.menu')
        const header = $('.header')
        const tabs = $('.tab')

        // Hide all tabs
        tabs.not(tabs.first()).hide()


        // Get first tab as dropdown select menu
        const firstIconTab = menuItems.first().clone()
        mobileContainer.prepend(firstIconTab)
        iconsTabsContainer.find('.icon_box').first().addClass('hide-mobile')

        // Open Mobile dropdown
        mobileContainer.on('click',function (e){
            e.stopPropagation();
            header.toggleClass('active');
        })

        // Close Mobile Dropdown on body
        $('body').on('click',function (){
            header.removeClass('active');
        })

        // Change tab
        menuItems.on('click',function(){
            if (!$(this).hasClass('current-tab')){
                const currentTab = $(this).index()
                changeTab(currentTab)
            }
        })

        function changeTab(currentTab){
            const selectedTab = tabs.eq(currentTab)
            const selectedIconTab = menuItems.eq(currentTab)

            selectedTab.fadeIn(700)
            tabs.not(selectedTab).hide()

            // Style Icon Box
            menuItems.removeClass("current-tab")
            selectedIconTab.addClass("current-tab")

            // Mobile dropdown menu
            mobileContainer.find('.menu-item').remove()
            mobileContainer.append(selectedIconTab.clone())
            menuItems.removeClass('hide-mobile')
            selectedIconTab.toggleClass('hide-mobile')
            header.toggleClass('active');

        }
    }

}

new HeaderMenu()