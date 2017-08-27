var Index = function () {

    // function to initiate Revolution Slider
    var runRevolution = function () {        
        jQuery("#fullwidthabnner").revolution({
            sliderType: "standard",
            sliderLayout: "auto",
            delay: 9000,
            minHeight: 450,
            navigation: {
                arrows: { enable: true },
                bullets: {
                    style: "",
                    enable: true,
                    container: "slider",
                    rtl: false,
                    hide_onmobile: false,
                    hide_onleave: true,
                    hide_delay: 200,
                    hide_delay_mobile: 1200,
                    hide_under: 0,
                    hide_over: 9999,
                    direction: "horizontal",
                    h_align: "center",
                    v_align: "bottom",
                    space: 5,
                    h_offset: 20,
                    v_offset: 20,
                    tmp:""
                }
            }
        });

    };
    // function to initiate Full Calendar
    var runColorbox = function () {
        $(".group1").colorbox({
            rel: 'group1',
            width: "85%"
        });
    };
    return {
        init: function () {
            runRevolution();
            runColorbox();
        }
    };
}();