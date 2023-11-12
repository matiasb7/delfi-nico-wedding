class HeaderMenu {
    constructor() {
        window.$ = window.jQuery = window.jquery = jQuery
        this.$header = $('.header')
        this.$menuItems = this.$header.find('.menu-item')
        this.$mobileContainer = this.$header.find('.mobile-menu-select')
        this.$iconsTabsContainer = this.$header.find('.menu')
        this.$tabs = $('.tab')
        this.handleMobileMenu()
        this.handleMenu()
    }

    handleMobileMenu() {
        // Get first tab as dropdown select menu
        const firstIconTab = this.$menuItems.first().clone()
        this.$mobileContainer.prepend(firstIconTab)
        this.$iconsTabsContainer.find('.menu-item').first().addClass('hide-mobile')

        // Open Mobile dropdown
        this.$mobileContainer.on('click', (e) =>{
            e.stopPropagation();
            this.$header.toggleClass('active');
        })

        // Close Mobile Dropdown on body
        $('body').on('click',() =>{
            this.$header.removeClass('active');
        })
    }

    handleMenu() {
        // Change Tab
        this.$menuItems.on('click',(e) =>{
            if (!$(e.target).hasClass('current-tab')){
                const currentTab = $(e.target).index()
                this.changeTab(currentTab)
            }
        })
    }

    changeTab(currentTab){
        const selectedTab = this.$tabs.eq(currentTab)
        const selectedIconTab = this.$menuItems.eq(currentTab)

        selectedTab.fadeIn(700)
        this.$tabs.not(selectedTab).hide()

        // Style Icon Box
        this.$menuItems.removeClass("current-tab")
        selectedIconTab.addClass("current-tab")

        // Mobile dropdown menu
        this.$mobileContainer.find('.menu-item').remove()
        this.$mobileContainer.prepend(selectedIconTab.clone())
        this.$menuItems.removeClass('hide-mobile')
        selectedIconTab.toggleClass('hide-mobile')
        this.$header.toggleClass('active');
    }
}

new HeaderMenu()