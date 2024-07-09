(function () {
    "use strict";

    /**
     * matches() pollyfil
     * @see https://developer.mozilla.org/en-US/docs/Web/API/Element/closest#Polyfill
     */
    if (!Element.prototype.matches) {
        Element.prototype.matches =
            Element.prototype.msMatchesSelector ||
            Element.prototype.webkitMatchesSelector;
    }

    /**
     * closest() pollyfil
     * @see https://developer.mozilla.org/en-US/docs/Web/API/Element/closest#Polyfill
     */
    if (!Element.prototype.closest) {
        Element.prototype.closest = function (s) {
            var el = this;
            if (!document.documentElement.contains(el)) {
                return null;
            }
            do {
                if (el.matches(s)) {
                    return el;
                }
                el = el.parentElement || el.parentNode;
            } while (el !== null && el.nodeType === 1);
            return null;
        };
    }

    window.onestoreHelper = {
        /**
         * Helper function to get element's offset.
         */
        getOffset: function ($el) {
            if ($el instanceof HTMLElement) {
                var rect = $el.getBoundingClientRect();

                return {
                    top: rect.top + window.pageYOffset,
                    left: rect.left + window.pageXOffset,
                };
            }

            return {
                top: null,
                left: null,
            };
        },

        /**
         * Helper function to check if element's visible or not.
         */
        isVisible: function ($el) {
            return $el.offsetWidth > 0 && $el.offsetHeight > 0;
        },

        /**
         * Function to check RTL
         */
        isRTL: function () {
            return document.body.classList.contains("rtl");
        },

        /**
         * Function to hide an element using slideUp animation.
         *
         * source: https://w3bits.com/javascript-slidetoggle/
         */
        slideUp: function (target, duration) {
            if (!target) return;

            duration = typeof duration !== "undefined" ? duration : 250;

            target.style.transitionProperty = "height, margin, padding";
            target.style.transitionDuration = duration + "ms";
            target.style.height = target.offsetHeight + "px";
            target.offsetHeight;
            target.style.overflow = "hidden";
            target.style.height = 0;
            target.style.paddingTop = 0;
            target.style.paddingBottom = 0;
            target.style.marginTop = 0;
            target.style.marginBottom = 0;

            window.setTimeout(function () {
                target.removeAttribute("style");
            }, duration);
        },

        /**
         * Function to show an element using slideDown animation.
         *
         * source: https://w3bits.com/javascript-slidetoggle/
         */
        slideDown: function (target, duration) {
            if (!target) return;

            duration = typeof duration !== "undefined" ? duration : 250;

            target.style.removeProperty("display");

            var display = window.getComputedStyle(target).display;
            if (display === "none") {
                display = "block";
            }
            target.style.display = display;

            var height = target.offsetHeight;

            target.style.overflow = "hidden";
            target.style.height = 0;
            target.style.paddingTop = 0;
            target.style.paddingBottom = 0;
            target.style.marginTop = 0;
            target.style.marginBottom = 0;
            target.offsetHeight;
            target.style.transitionProperty = "height, margin, padding";
            target.style.transitionDuration = duration + "ms";
            target.style.height = height + "px";
            target.style.removeProperty("padding-top");
            target.style.removeProperty("padding-bottom");
            target.style.removeProperty("margin-top");
            target.style.removeProperty("margin-bottom");

            window.setTimeout(function () {
                target.style.removeProperty("height");
                target.style.removeProperty("overflow");
                target.style.removeProperty("transition-duration");
                target.style.removeProperty("transition-property");
            }, duration);
        },

        /**
         * Function to toggle visibility of an element using slideUp or SlideDown animation.
         *
         * source: https://w3bits.com/javascript-slidetoggle/
         */
        slideToggle: function (target, duration) {
            if (!target) return;

            duration = typeof duration !== "undefined" ? duration : 250;

            if (window.getComputedStyle(target).display === "none") {
                return slideDown(target, duration);
            } else {
                return slideUp(target, duration);
            }
        },
    };

    window.oneStoreQuickViewCurrent = undefined;
    window.onestore = {
        /**
         * Function to init different style of focused element on keyboard users and mouse users.
         */
        initKeyboardAndMouseFocus: function () {
            document.body.addEventListener(
                "keydown",
                function (e) {
                    document.body.classList.add("using-keyboard");
                },
                false
            );

            document.body.addEventListener(
                "mousedown",
                function (e) {
                    document.body.classList.remove("using-keyboard");
                },
                false
            );
        },

        /**
         * Function to init edge sub menu detection script.
         */
        initDropdownMenuReposition: function () {
            var anchorSide = window.onestoreHelper.isRTL() ? "left" : "right";

            var calculateSubMenuEdge = function () {
                var $submenus = Array.prototype.slice.call(
                    document.querySelectorAll(
                        ".header-section .menu > * > .sub-menu"
                    )
                );
                $submenus.forEach(function ($submenu) {
                    var $section = $submenu.closest(".header-section"),
                        $container = $section.classList.contains(
                            "section-contained"
                        )
                            ? $section.querySelector(".section-inner")
                            : $submenu.closest(".wrapper");

                    // Reset inline styling.
                    $submenu.classList.remove("onestore-sub-menu-edge");
                    $submenu.style[anchorSide] = "";

                    $submenu.style.maxWidth = $container.offsetWidth + "px";

                    var containerEdge = $container.getBoundingClientRect()[
                            anchorSide
                        ],
                        submenuEdge = $submenu.getBoundingClientRect()[
                            anchorSide
                        ],
                        isSubmenuOverflow = window.onestoreHelper.isRTL()
                            ? submenuEdge < containerEdge
                            : submenuEdge > containerEdge;

                    // Apply class and left position.
                    if (isSubmenuOverflow) {
                        $submenu.classList.add("onestore-sub-menu-edge");
                        $submenu.style[anchorSide] = 0;
                    }

                    // Apply vertical max-height.
                    $submenu.style.maxHeight =
                        window.innerHeight -
                        $submenu.getBoundingClientRect().top +
                        "px";

                    // Iterate to 2nd & higher level submenu.
                    var $subsubmenus = Array.prototype.slice.call(
                        $submenu.querySelectorAll(".sub-menu")
                    );
                    $subsubmenus.forEach(function ($subsubmenu) {
                        var subsubmenuEdge =
                                $subsubmenu.getBoundingClientRect().left +
                                (window.onestoreHelper.isRTL()
                                    ? 0
                                    : $subsubmenu.getBoundingClientRect()
                                          .width),
                            isSubsubmenuOverflow = window.onestoreHelper.isRTL()
                                ? subsubmenuEdge < containerEdge
                                : subsubmenuEdge > containerEdge;

                        // Reset inline styling.
                        $subsubmenu.classList.remove("onestore-sub-menu-right");

                        // Apply class and left position.
                        if (isSubsubmenuOverflow) {
                            $subsubmenu.classList.add(
                                "onestore-sub-menu-right"
                            );
                        }

                        // Apply vertical max-height.
                        $subsubmenu.style.maxHeight =
                            window.innerHeight -
                            $subsubmenu.getBoundingClientRect().top +
                            "px";
                    });
                });
            };

            window.addEventListener("resize", calculateSubMenuEdge, false);
            calculateSubMenuEdge();
        },

        /**
         * Function to init hover menu.
         */
        initMenuAccessibility: function () {
            /**
             * Accesibility using tab button
             * ref: https://github.com/wpaccessibility/a11ythemepatterns/blob/master/dropdown-menus/vanilla-js/js/dropdown.js
             */
            var handleMenuFocusUsingKeyboard = function (e) {
                var $this = e.target,
                    $menu = $this.closest(".onestore-hover-menu"),
                    $current = this;

                while ($current !== $menu) {
                    if ($current.classList.contains("menu-item")) {
                        if ($current.classList.contains("focus")) {
                            $current.classList.remove("focus");
                        } else {
                            $current.classList.add("focus");
                        }
                    }
                    $current = $current.parentElement;
                }
            };
            var $menuLinks = Array.prototype.slice.call(
                document.querySelectorAll(".onestore-hover-menu .menu-item > a")
            );
            $menuLinks.forEach(function ($menuLink) {
                $menuLink.addEventListener(
                    "focus",
                    handleMenuFocusUsingKeyboard,
                    true
                );
                $menuLink.addEventListener(
                    "blur",
                    handleMenuFocusUsingKeyboard,
                    true
                );
            });

            /**
             * Accesibility using arrow nav buttons
             * ref: https://github.com/wpaccessibility/a11ythemepatterns/blob/master/menu-keyboard-arrow-nav/vanilla-js/js/navigation.js
             */
            var handleMenuNavigationUsingKeyboard = function (e) {
                // Check target element.
                var $this = e.target.closest(
                    ".onestore-hover-menu .menu-item > a"
                );
                if (!$this) return;

                var key = e.which || e.keyCode;

                // left key
                if (37 === key) {
                    e.preventDefault();

                    if ($this.parentElement.previousElementSibling) {
                        $this.parentElement.previousElementSibling.firstElementChild.focus();
                    }
                }
                // right key
                else if (39 === key) {
                    e.preventDefault();

                    if ($this.parentElement.nextElementSibling) {
                        $this.parentElement.nextElementSibling.firstElementChild.focus();
                    }
                }
                // down key
                else if (40 === key) {
                    e.preventDefault();

                    if ($this.nextElementSibling) {
                        $this.nextElementSibling.firstElementChild.firstElementChild.focus();
                    } else if ($this.parentElement.nextElementSibling) {
                        $this.parentElement.nextElementSibling.firstElementChild.focus();
                    }
                }
                // up key
                else if (38 === key) {
                    e.preventDefault();

                    if ($this.parentElement.previousElementSibling) {
                        $this.parentElement.previousElementSibling.firstElementChild.focus();
                    } else if (
                        $this.parentElement.parentElement.previousElementSibling
                    ) {
                        $this.parentElement.parentElement.previousElementSibling.focus();
                    }
                }
            };
            document.addEventListener(
                "keydown",
                handleMenuNavigationUsingKeyboard,
                false
            );
        },

        /**
         * Function to init double tap menu on mobile devices.
         */
        initDoubleTapMobileMenu: function () {
            /**
             * Mobile Touch friendly
             */
            var handleMenuOnMobile = function (e) {
                // Check target element.
                var $this = e.target.closest(
                    ".onestore-hover-menu .menu-item > a"
                );
                if (!$this) return;

                var $menuItem = $this.parentElement;

                // Only enable double tap on menu item that has sub menu and it's not a empty hash link.
                if ($menuItem.classList.contains("menu-item-has-children")) {
                    if ($this !== document.activeElement) {
                        e.preventDefault(); // Prevent touchend action here (before manually set the focus) to allow focus actions below.

                        document.activeElement.blur();
                        $this.focus();
                    }
                }
            };
            document.addEventListener("touchend", handleMenuOnMobile, false);
        },

        /**
         * Function to init toggle menu.
         */
        initClickToggleDropdownMenu: function () {
            var $clickedToggle = null;

            /**
             * Toggle Handler
             */
            var handleSubMenuToggle = function (e) {
                // Check target element.
                var $this = e.target.closest(
                    ".header-section .action-toggle-menu .sub-menu-toggle"
                );
                if (!$this) return;

                e.preventDefault();

                var $header = document.getElementById("masthead"),
                    $menuItem = $this.parentElement;

                // Menu item already has "focus" class, so collapses itself.
                if ($menuItem.classList.contains("focus")) {
                    $menuItem.classList.remove("focus");
                    $this.setAttribute("aria-expanded", false);
                    try {
                        if (forSelector && toggleClass) {
                            document
                                .querySelector(forSelector)
                                .classList.remove(toggleClass);
                        }
                    } catch (e) {}
                }
                // Menu item doesn't have "focus" class yet, so collapses other focused menu items found in the header and focuses this menu item.
                else {
                    var $focusedMenuItems = Array.prototype.slice.call(
                        $header.querySelectorAll(".menu-item.focus")
                    );
                    $focusedMenuItems.forEach(function ($focusedMenuItem) {
                        $focusedMenuItem.classList.remove("focus");
                    });

                    $menuItem.classList.add("focus");
                    $this.setAttribute("aria-expanded", true);

                    // Move focus to search bar (if exists).
                    var $searchBar = $menuItem.querySelector(
                        'input[type="search"]'
                    );
                    if ($searchBar) {
                        var $subMenu = $searchBar.closest(".sub-menu");

                        var focusSearchBar = function () {
                            $searchBar.click();

                            $subMenu.removeEventListener(
                                "transitionend",
                                focusSearchBar
                            );
                        };

                        $subMenu.addEventListener(
                            "transitionend",
                            focusSearchBar
                        );
                    }

                    // Save this toggle for putting back focus when popup is deactivated.
                    $clickedToggle = $this;
                }
            };
            document.addEventListener("click", handleSubMenuToggle, false);
            document.addEventListener("touchend", handleSubMenuToggle, false);

            /**
             * Close Handler
             */
            var handleSubMenuClose = function (e) {
                // Make sure click event doesn't happen inside the menu item's scope.
                if (!e.target.closest(".header-section .action-toggle-menu")) {
                    var $header = document.getElementById("masthead"),
                        $focusedMenuItems;

                    if ($header) {
                        var $focusedMenuItems = Array.prototype.slice.call(
                            $header.querySelectorAll(
                                ".action-toggle-menu .menu-item.focus"
                            )
                        );
                        $focusedMenuItems.forEach(function ($focusedMenuItem) {
                            $focusedMenuItem.classList.remove("focus");
                            $clickedToggle.setAttribute("aria-expanded", false);
                        });
                    }
                }
            };
            document.addEventListener("click", handleSubMenuClose, false);
            document.addEventListener("touchend", handleSubMenuClose, false);
        },

        handleTabIndexMenuItems: function ($submenu) {
            var menu = document.querySelector("#menu-mobile-menu");
            var focusableSelector = "a, button:not([disabled])";
            var items = menu.querySelectorAll(focusableSelector);
            var focusItems;
            if (items.length) {
                items.forEach(function (el) {
                    el.setAttribute("tabindex", "-1");
                });
            }
            // Active first level only
            if (!$submenu) {
                focusItems = menu.querySelectorAll(
                    ":scope > li > a, :scope > li > button"
                );
                focusItems.forEach(function (el) {
                    el.setAttribute("tabindex", 0);
                });
            } else {
                focusItems = $submenu.querySelectorAll(
                    ":scope .sub-menu > li > a, :scope .sub-menu > li > button"
                );
                focusItems.forEach(function (el) {
                    el.setAttribute("tabindex", 0);
                });
            }
        },

        addSubMenuHeading: function () {
            var self = this;
            // Add heading Title and Close button for submenu.
            let submenus = document.querySelectorAll(
                "#menu-mobile-menu .sub-menu"
            );
            for (let i = 0; i < submenus.length; i++) {
                let sub = submenus[i];
                let parent = sub.parentNode;
                let gParent = parent.parentNode;
                let title = parent.querySelector(".menu-item-link").innerHTML;
                let letButton = parent.querySelector(".sub-menu-toggle")
                    .innerHTML;
                let liHeading = document.createElement("li");
                liHeading.classList.add("sub-menu-heading");
                liHeading.innerHTML =
                    '<button class="action-toggle onestore-back">' +
                    letButton +
                    "</button>" +
                    title;
                sub.prepend(liHeading);
                liHeading.addEventListener("click", function (e) {
                    e.preventDefault();
                    parent.classList.remove("focus");
                    gParent.classList.remove("open");
                    parent.classList.remove("parent-open");
                    gParent.classList.remove("parent-open");
                    gParent.parentNode.classList.remove("parent-open");
                    if (gParent.classList.contains("menu")) {
                        document
                            .querySelector("#mobile-vertical-header")
                            .classList.remove("open");
                        self.handleTabIndexMenuItems();
                    } else {
                        if (gParent.classList.contains("open")) {
                            self.handleTabIndexMenuItems(
                                gParent.querySelector(":scope > .sub-menu")
                            );
                        }
                    }
                });
            }
        },

        /**
         * Function to init mobile menu.
         */
        initAccordionMenu: function () {
            this.addSubMenuHeading();
            var self = this;

            var wrapper = document.querySelector("#mobile-vertical-header");
            self.handleTabIndexMenuItems();
            /**
             * Toggle Handler
             */
            var handleAccordionMenuToggle = function (e) {
                // Check target element.
                var $this = e.target.closest(
                    ".header-section-vertical .action-toggle-menu .sub-menu-toggle"
                );
                if (!$this) return;

                e.preventDefault();

                var $menuItem = $this.parentElement;
                var parentMenu = $menuItem.parentElement;
                var grandpaMenu = parentMenu.parentElement;

                let isRoot = false;
                if (parentMenu.classList.contains("menu")) {
                    isRoot = true;
                }

                self.handleTabIndexMenuItems();
                // Menu item already has "focus" class, so collapses itself and all menu items inside.
                if ($menuItem.classList.contains("focus")) {
                    //window.onestoreHelper.slideUp($subMenu);
                    $menuItem.classList.remove("focus");
                    parentMenu.classList.remove("open");
                    if (isRoot) {
                        wrapper.classList.remove("open");
                    }
                    grandpaMenu.classList.remove("parent-open");
                } else {
                    // Menu item doesn't have "focus" class yet, so collapses all focused siblings and focuses this menu item.
                    parentMenu.classList.add("open");
                    $menuItem.classList.add("focus");
                    if (isRoot) {
                        wrapper.classList.add("open");
                    }
                    self.handleTabIndexMenuItems(parentMenu);
                    grandpaMenu.classList.add("parent-open");
                }
            };
            document.addEventListener(
                "click",
                handleAccordionMenuToggle,
                false
            );
            document.addEventListener(
                "touchend",
                handleAccordionMenuToggle,
                false
            );

            /**
             * Empty Hash Link Handler
             */
            var handleAccordionMenuEmptyHashLink = function (e) {
                // Check target element.
                var $this = e.target.closest(
                    '.header-section-vertical .action-toggle-menu .menu-item-has-children > .onestore-menu-item-link[href="#"]'
                );
                if (!$this) return;

                e.preventDefault();

                var $menuItem = $this.parentElement,
                    $toggle = $menuItem.querySelector(".sub-menu-toggle");

                // If an empty hash link is clicked, trigger the toggle click event.
                // ref: https://gomakethings.com/how-to-simulate-a-click-event-with-javascript/
                $toggle.click();
            };
            document.addEventListener(
                "click",
                handleAccordionMenuEmptyHashLink,
                false
            );
            document.addEventListener(
                "touched",
                handleAccordionMenuEmptyHashLink,
                false
            );
        },
        /**
         * Function to toggle sections
         */
        initToggleSections: function () {
            /**
             * Toggle Handler
             */
            var handleToggleToggle = function (e) {
                // Check target element.
                var $this = e.target.closest(
                    ".toggle-section .toggle-section--heading"
                );
                if (!$this) return;

                e.preventDefault();

                var $parent = $this.parentElement;
                var $child = $parent.querySelector(".toggle-section--content");

                if ($parent.classList.contains("open")) {
                    $parent.classList.remove("open");
                    window.onestoreHelper.slideUp($child);
                } else {
                    window.onestoreHelper.slideDown($child);
                    $parent.classList.add("open");
                }
            };
            document.addEventListener("click", handleToggleToggle, false);
            document.addEventListener("touchend", handleToggleToggle, false);
        },

        /**
         * Function to toggle sections
         */
        initToggleWidgets: function () {
            /**
             * Toggle Handler
             */
            var handleToggleWidget = function (e) {
                // Check target element.
                var $this = e.target.closest("#secondary .widget-title");
                if (!$this) return;

                e.preventDefault();

                var $parent = $this.parentElement;
                var $child = $parent.querySelector(
                    ":scope >*:not(.widget-title)"
                );
                if ($parent.classList.contains("open")) {
                    $parent.classList.remove("open");
                    window.onestoreHelper.slideUp($child);
                } else {
                    window.onestoreHelper.slideDown($child);
                    $parent.classList.add("open");
                }
            };
            document.addEventListener("click", handleToggleWidget, false);
            document.addEventListener("touchend", handleToggleWidget, false);
        },

        /**
         * Function to init page popup toggle.
         */
        initGlobalPopup: function () {
            var $clickedToggle = null;

            var deactivatePopup = function (device) {
                var $activePopups = Array.prototype.slice.call(
                    document.querySelectorAll(
                        ".popup-active" +
                            (undefined !== device
                                ? ".onestore-hide-on-" + device
                                : "")
                    )
                );

                window.oneStoreQuickViewCurrent = undefined;

                $activePopups.forEach(function ($activePopup) {
                    // Deactivate popup.
                    if ($clickedToggle) {
                        $clickedToggle.classList.remove("popup-toggle-active");
                        $clickedToggle.setAttribute("aria-expanded", false);
                    }

                    $activePopup.classList.remove("popup-active");
                    document.body.classList.remove("onestore-has-popup-active");

                    // Back current focus to the toggle.
                    $activePopup.removeAttribute("tabindex");
                    if (document.body.classList.contains("using-keyboard")) {
                        if ($clickedToggle) {
                            $clickedToggle.focus();
                        }
                    }
                });
            };

            // Show / hide popup when the toggle is clicked.
            var handlePopupToggle = function (e) {
                // Check target element.
                var $this = e.target.closest(".popup-toggle");
                if (!$this) return;

                e.preventDefault();

                var $target = document.querySelector(
                    "#" + $this.getAttribute("data-target")
                );

                // Abort if no popup target found.
                if (!$target) return;

                if ($target.classList.contains("popup-active")) {
                    deactivatePopup();
                } else {
                    // Activate popup.
                    $this.classList.add("popup-toggle-active");
                    $this.setAttribute("aria-expanded", true);
                    $target.classList.add("popup-active");
                    document.body.classList.add("onestore-has-popup-active");

                    // Put focus on popup.
                    setTimeout(function () {
                        $target.setAttribute("tabindex", 1);
                        $target.focus();
                    }, 300);

                    // Save this toggle for putting back focus when popup is deactivated.
                    $clickedToggle = $this;
                }
            };
            document.addEventListener("click", handlePopupToggle, false);
            document.addEventListener("touchend", handlePopupToggle, false);

            // Close popup when any of ".popup-close" element is clicked.
            var handlePopupClose = function (e) {
                // Check target element.
                if (!e.target.closest(".popup-close")) return;

                e.preventDefault();

                deactivatePopup();
            };
            document.addEventListener("click", handlePopupClose, false);
            document.addEventListener("touchend", handlePopupClose, false);

            // Close popup using "escape" keyboard button.
            var handlePopupEscape = function (e) {
                var key = e.which || e.keyCode;

                if (
                    document.body.classList.contains(
                        "onestore-has-popup-active"
                    ) &&
                    27 === key
                ) {
                    deactivatePopup();
                }
            };
            document.addEventListener("keydown", handlePopupEscape, false);

            // When window resize, close Active Popups based on their responsive visibility classes.
            var handleResponsiveVisibility = function (e) {
                document.body.classList.remove("desktop", "tablet", "mobile");

                if (
                    document.body.classList.contains(
                        "onestore-has-popup-active"
                    )
                ) {
                    var device = "mobile";

                    if (
                        onestoreConfig.breakpoints.mobile <= window.innerWidth
                    ) {
                        device = "tablet";
                    }

                    if (
                        onestoreConfig.breakpoints.desktop <= window.innerWidth
                    ) {
                        device = "desktop";
                    }

                    deactivatePopup(device);
                }
            };
            window.addEventListener(
                "resize",
                handleResponsiveVisibility,
                false
            );

            // Close popup if any hash link is clicked.
            var handleHashLinkInsidePopup = function (e) {
                // Check target element.
                if (!e.target.closest(".popup a")) return;

                var $link = e.target.closest("a");

                // Check if the link is a hash link.
                if ("" !== $link.hash) {
                    var pageURL = (
                            window.location.hostname +
                            "/" +
                            window.location.pathname
                        ).replace("//$/", ""),
                        linkURL = (
                            $link.hostname +
                            "/" +
                            $link.pathname
                        ).replace("//$/", "");

                    // Check if the hash target is on this page.
                    if (pageURL === linkURL) {
                        // Deactivate all popups.
                        if (
                            document.body.classList.contains(
                                "onestore-has-popup-active"
                            )
                        ) {
                            deactivatePopup();
                        }
                    }
                }
            };
            document.addEventListener(
                "click",
                handleHashLinkInsidePopup,
                false
            );
            document.addEventListener(
                "touchend",
                handleHashLinkInsidePopup,
                false
            );
        },

        /**
         * Function to init scroll to top.
         */
        initScrollToTop: function () {
            var $scrollToTop = document.querySelector(
                ".onestore-scroll-to-top"
            );

            if ($scrollToTop) {
                var handleScrollToTop = function (e) {
                    // Check target element.
                    if (!e.target.closest(".onestore-scroll-to-top")) return;

                    e.preventDefault();

                    var $link = e.target.closest(".onestore-scroll-to-top"),
                        $target = document.getElementById(
                            $link.getAttribute("href").replace("#", "")
                        );

                    if ($target) {
                        window.scrollTo({
                            top: $target.getBoundingClientRect().top,
                            behavior: "smooth",
                        });
                    }
                };
                document.addEventListener("click", handleScrollToTop, false);
                document.addEventListener("touchend", handleScrollToTop, false);

                if (
                    $scrollToTop.classList.contains(
                        "onestore-scroll-to-top-display-sticky"
                    )
                ) {
                    var checkStickyOffset = function () {
                        if (window.pageYOffset > 0.5 * window.innerHeight) {
                            $scrollToTop.classList.add("onestore-sticky");
                        } else {
                            $scrollToTop.classList.remove("onestore-sticky");
                        }
                    };
                    window.addEventListener("scroll", checkStickyOffset, false);
                    checkStickyOffset();
                }
            }
        },

        initDevices: function () {
            if (window.onestoreResizeTimeout) {
                clearTimeout(window.onestoreResizeTimeout);
            }

            window.onestoreResizeTimeout = setTimeout(function () {
                let device = "mobile";

                if (onestoreConfig.breakpoints.tablet <= window.innerWidth) {
                    device = "desktop";
                }

                if (
                    onestoreConfig.breakpoints.mobile <= window.innerWidth &&
                    onestoreConfig.breakpoints.tablet >= window.innerWidth
                ) {
                    device = "tablet";
                }

                if (onestoreConfig.breakpoints.mobile >= window.innerWidth) {
                    device = "mobile";
                }
                document.body.setAttribute("data-device", device);
            }, 50);
        },

        /**
         * Function to init more/less
         */
        initMoreLess: function () {
            var $clickedToggle = null;

            // Show / hide popup when the toggle is clicked.
            var handleMoreLessToggle = function (e) {
                // Check target element.
                var $target = e.target.closest(".more-action");
                if (!$target) return;

                e.preventDefault();

                // Abort if no popup target found.
                if (!$target) return;

                let moreText = $target.getAttribute("data-more") || "Show more";
                let lessText = $target.getAttribute("data-less") || "Show less";

                let $parent = $target.parentElement;
                if ($parent.classList.contains("show-full")) {
                    $parent.classList.remove("show-full");
                    $target.innerHTML = moreText;
                } else {
                    $parent.classList.add("show-full");
                    $target.innerHTML = lessText;
                }
            };
            document.addEventListener("click", handleMoreLessToggle, false);
            document.addEventListener("touchend", handleMoreLessToggle, false);
        },

        /**
         * Function that calls all init functions.
         */
        initAll: function () {
            onestore.device = "";
            onestore.$clickedToggle = null;
            onestore.initDevices();
            window.addEventListener("resize", onestore.initDevices);

            window.onestore.initKeyboardAndMouseFocus();
            window.onestore.initDropdownMenuReposition();
            window.onestore.initMenuAccessibility();
            window.onestore.initClickToggleDropdownMenu();
            window.onestore.initDoubleTapMobileMenu();
            window.onestore.initAccordionMenu();
            window.onestore.initToggleSections();
            window.onestore.initToggleWidgets();
            window.onestore.initGlobalPopup();
            window.onestore.initScrollToTop();
            window.onestore.initMoreLess();
        },
    };

    document.addEventListener(
        "DOMContentLoaded",
        window.onestore.initAll,
        false
    );

    // -----------
    //see https://codepen.io/elifitch/pen/Cobzr
    var headerMainDesktop = document.getElementById("header-main-bar");
    if (headerMainDesktop) {
        var stuckDesktop = false;
        var stickDesktopPoint = headerMainDesktop.offsetTop;

        var headerMainMobile = document.getElementById(
            "header-mobile-main-bar"
        );
        var stuckMobile = false;
        var stickMobilePoint = headerMainMobile.offsetTop;
        let isStickyDesktop = headerMainDesktop.classList.contains("is-sticky");
        let isStickyMobile = headerMainMobile.classList.contains("is-sticky");

        let checkHeaderMainSticky = function () {
            if (!isStickyDesktop) {
                return;
            }
            let offset = window.pageYOffset;
            let distance = headerMainDesktop.offsetTop - window.pageYOffset;
            if (distance <= 0 && !stuckDesktop) {
                headerMainDesktop.classList.add("scroll-fixed");
                stuckDesktop = true;
            } else if (stuckDesktop && offset <= stickDesktopPoint) {
                headerMainDesktop.classList.remove("scroll-fixed");
                stuckDesktop = false;
            }
        };

        let checkHeaderMobileSticky = function () {
            if (!isStickyMobile) {
                return;
            }
            let offset = window.pageYOffset;
            let distanceMobile =
                headerMainMobile.offsetTop - window.pageYOffset;
            if (distanceMobile <= 0 && !stuckMobile) {
                headerMainMobile.classList.add("scroll-fixed");
                stuckMobile = true;
            } else if (stuckMobile && offset <= stickMobilePoint) {
                headerMainMobile.classList.remove("scroll-fixed");
                stuckMobile = false;
            }
        };
        checkHeaderMainSticky();
        checkHeaderMobileSticky();

        window.onscroll = function (e) {
            checkHeaderMainSticky();
            checkHeaderMobileSticky();
        };
    }

    // For WC
    if (typeof jQuery !== "undefined") {
        jQuery(function ($) {
            /**
             * Stores the default text for an element so it can be reset later
             */
            $.fn.onestore_set_content = function (content) {
                if (undefined === this.attr("data-o_content")) {
                    this.attr("data-o_content", this.html());
                }
                this.html(content);
            };

            /**
             * Stores the default text for an element so it can be reset later
             */
            $.fn.onestore_reset_content = function () {
                if (undefined !== this.attr("data-o_content")) {
                    this.html(this.attr("data-o_content"));
                }
            };

            $(document.body).on("added_to_cart", function () {
                let $button = $(".shopping-cart-link.popup-toggle");
                $button.get(0).click();
            });

            const $cartForm = $(".onestore-product-add-to-cart form.cart");
            const $cartSticky = $("#cart-sticky");
            if ($cartSticky.length) {
                $("body").css("padding-bottom", $cartSticky.height());
                $(document).on("resize", function (e) {
                    $("body").css("padding-bottom", $cartSticky.height());
                });
                $(document).on("scroll", function (e) {
                    var top = $(document).scrollTop();
                    let formOffset = $cartForm.offset();
                    var h = $cartForm.height();
                    let bottom = formOffset.top + h;
                    if (top > bottom) {
                        $cartSticky.addClass("sticky");
                    } else {
                        $cartSticky.removeClass("sticky");
                    }
                });

                $(".cart-sticky-btn").on("click", function (e) {
                    e.preventDefault();
                    let $btn = $cartForm.find(".single_add_to_cart_button");
                    if ($btn.hasClass("disabled")) {
                        window.scrollTo({
                            top: $cartForm.offset().top,
                            behavior: "smooth",
                        });
                        return;
                    }
                    $btn.trigger("click");
                });

                // Found variation.
                $cartForm.on("found_variation", function (e, variation) {
                    let $btn = $cartForm.find(".single_add_to_cart_button");
                    try {
                        $cartSticky
                            .find(".cart-sticky-price")
                            .onestore_set_content(variation.price_html);
                        $cartSticky
                            .find(".cart-sticky-btn")
                            .onestore_set_content($btn.html());
                    } catch (e) {}
                });

                // No variation.
                $cartForm.on("reset_data", function (e) {
                    try {
                        $cartSticky
                            .find(".cart-sticky-btn")
                            .onestore_reset_content();
                        $cartSticky
                            .find(".cart-sticky-price")
                            .onestore_reset_content();
                    } catch (e) {}
                });
            } // end if sticky add to cart.

            // Ajax Load more.

            $.fn.ajaxLoadMore = function (options) {
                var defaults = {
                        btn: ".woocommerce-pagination .next",
                        items: ".main-products-list li",
                    },
                    options = $.extend(defaults, options);

                $(document).on("click", options.btn, function (e) {
                    let $button = $(this);
                    e.preventDefault();
                    let link = $button.attr("href");
                    $button.addClass("loading disabled");
                    var url = new URL(link);
                    url.searchParams.set("onestore_ajax_more", "1");
                    const $wrapper = $("#main .main-products-list");
                    $.ajax({
                        url: url,
                        success: function (res) {
                            let $html = $(res.content);
                            let $items = $html.find(options.items);
                            $wrapper.append($items);
                            $button.removeClass("loading disabled");
                            // find next link button.
                            $(document).trigger("onestore_ajax_more_loaded", [
                                $items,
                                res,
                            ]);
                            let $next = $html.find(options.btn);
                            if ($next.length) {
                                $button.attr("href", $next.attr("href"));
                            } else {
                                // End load more.
                                $button.remove();
                            }
                        },
                    });
                });
            }; // End ajax load more.

            $(".main-products-list").ajaxLoadMore({
                items: ".main-products-list .product",
            });

            // END Ajax Load more.

            // Ajax Filter
            $(document).on(
                "click",
                ".woocommerce-widget-layered-nav-list a, .widget_layered_nav_filters a",
                function (e) {
                    e.preventDefault();
                    const link = $(this).attr("href");
                    const url = new URL(link);
                    url.searchParams.set("onestore_ajax_more", "1");
                    window.history.pushState({}, null, link);

                    $.ajax({
                        url: url,
                        success: function (res) {
                            let $html = $(res.content);

                            $html.find(".widget-area").each(function () {
                                let $w = $(this);
                                let id = $w.attr("id") || false;
                                if (id) {
                                    $(`#${id}`).replaceWith($w);
                                }
                            });

                            $("#main").replaceWith($html.find("#main"));
                            const $items = $("#main .main-products-list li");
                            $(document).trigger("onestore_ajax_more_loaded", [
                                $items,
                                res,
                            ]);
                            //  ReInit filter slider.
                            $(document.body).trigger("init_price_filter");
                        },
                    });
                }
            );
            // End ajax filter.

            // Orderby
            $(document).on(
                "change",
                ".woocommerce-ordering select.orderby",
                function () {
                    $(this).closest("form").trigger("submit");
                }
            );

            // quick view.
            let $quickViewBtn = undefined;
            if (typeof onestoreConfig.is_quick_view === "undefined") {
                window.addEventListener("message", function (e) {
                    if (e.data && e.data.previewReady) {
                        $quickViewBtn.removeClass("loading");
                        if (window.oneStoreQuickViewCurrent) {
                            window.oneStoreQuickViewCurrent
                                .find(".popup-content")
                                .height(e.data.height);

                            window.oneStoreQuickViewCurrent.addClass(
                                "popup-active"
                            );
                        }
                    }
                });

                $(".ajax-quick-view").on("click", function (e) {
                    e.preventDefault();
                    $quickViewBtn = $(this);
                    var link = $(this).attr("href");
                    var id = $(this).data("productId");
                    let modalID = "p-quick-view-" + id;
                    $quickViewBtn.addClass("loading");
                    if ($("#" + modalID).length) {
                        $("#" + modalID).addClass("popup-active");
                        window.oneStoreQuickViewCurrent = $("#" + modalID);

                        window.oneStoreQuickViewCurrent
                            .find("#iframe-" + modalID)
                            .get(0)
                            .contentWindow.postMessage({
                                eventType: "reopen",
                            });
                    } else {
                        var url = new URL(link);
                        url.searchParams.set("onestore_quick_view", "1");
                        let templateHTML = $("#onestore-quick-view-tpl").html();
                        templateHTML.replace(
                            "onestore-qv-modal-tpl-id",
                            modalID
                        );
                        let $html = $(templateHTML);
                        $html.attr("id", modalID);
                        $html
                            .find(".popup-entry")
                            .html(
                                `<iframe id="iframe-${modalID}" class="product-preview-iframe" src="${url}"></iframe>`
                            );
                        $html.addClass("product-quick-view");
                        $("body").append($html);
                        window.oneStoreQuickViewCurrent = $html;
                    }
                });
            } else if (onestoreConfig.is_quick_view === "1") {
                if (self === top) {
                    let currentURL = new URL(window.location);
                    currentURL.searchParams.delete("onestore_quick_view");
                    window.location = currentURL;
                } else {
                    $("form, a").attr("target", "_top");
                    let viewHeight = $("#page").height() || 0;

                    window.addEventListener("message", function (e) {
                        if (e.data && e.data.eventType === "reopen") {
                            window.parent.postMessage({
                                previewReady: true,
                                height: viewHeight,
                            });
                        }
                    });

                    window.parent.postMessage({
                        previewReady: true,
                        height: viewHeight,
                    });
                }
            }
        }); // end if jQUery.
    }
    // END For WC
})();
