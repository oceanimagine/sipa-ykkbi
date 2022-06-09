/* ---------------------------------------------------------------------- */
/* Form Reward */

var checkr = 0;

$("#allreward").on('ifChecked', function () {
    for (var i = 0; i < rewrdarr.length; i++) {
        $('#' + rewrdarr[i] + (i + 1)).iCheck('check');
    }
    checkr = 0;
});

$("#allreward").on('ifUnchecked', function () {
    if (checkr === 0) {
        for (var i = 0; i < rewrdarr.length; i++) {
            $('#' + rewrdarr[i] + (i + 1)).iCheck('uncheck');
        }
    }
});

for (var i = 0; i < rewrdarr.length; i++) {
    var checkreward = document.getElementById(rewrdarr[i] + (i + 1));
    checkreward.counter = (i + 1);
    $('#' + rewrdarr[i] + (i + 1)).on('ifChecked', function () {
        $('#DIVS_' + rewrdarr[(this.counter - 1)] + this.counter + "REWARD").slideDown("slow");
    });
    $('#' + rewrdarr[i] + (i + 1)).on('ifUnchecked', function () {
        checkr = 1;
        $('#allreward').iCheck('uncheck');
        $('#DIVS_' + rewrdarr[(this.counter - 1)] + this.counter + "REWARD").slideUp("slow");
    });
}

for (var i = 0; i < rewrdarr.length; i++) {
    var objs = document.getElementById("ID_" + rewrdarr[i] + "REWARD");
    if (objs.getAttribute("modelinput") === "select") {
        objs.tampung = [];
        $("#ID_" + rewrdarr[i] + "REWARD").change(function () {
            this.tampung = $(this).val();
            /* console.log($(this).val()); */
        });
    }
    if (objs.getAttribute("modelinput") === "text") {
        if (objs.getAttribute("inputreward") === "Money") {
            beginNumber("ID_" + rewrdarr[i] + "REWARD");
        }
        if (objs.getAttribute("inputreward") === "Number") {
            beginNumber("ID_" + rewrdarr[i] + "REWARD", "regular");
        }
    }
}

$("#step-SubmitReward").click(function () {
    $('#formreward').slideUp("slow");
    $('#formlabel').slideUp("slow");
    $('#allreward').iCheck('uncheck');
    var lbl01 = document.getElementById("tipeLabel");
    var lbl03 = document.getElementById("formlabelButton");
    lbl01.style.display = "block";
    lbl03.style.display = "block";
    for (var i = 0; i < rewrdarr.length; i++) {
        $('#' + rewrdarr[i] + (i + 1)).iCheck('uncheck');
    }
    changedble = "";
    rewardlist();
    refreshreward();
});

function rewardlist() {
    var result = "";
    var trbrss = document.getElementById("reward" + bariskeReward);
    for (var i = 0; i < rewrdarr.length; i++) {
        var dvhdd = document.getElementById("tampunghidden");
        var inphd = dvhdd.getElementsByTagName("input");
        for(var j = 0; j < inphd.length; j++){
            if(inphd[j] && inphd[j].getAttribute("labelnya") === 'reward_' + rewrdarr[i] + (bariskeReward - 1)){
                inphd[j].parentNode.removeChild(inphd[j]);
            }
        }
    }
    for (var i = 0; i < rewrdarr.length; i++) {
        var objs = document.getElementById("ID_" + rewrdarr[i] + "REWARD");
        if (objs.getAttribute("modelinput") === "text") {
            if (objs.value !== "") {
                result = result + "<li>" + rewrdarr[i] + " : " + objs.value + "</li>";
                tampunghdd.innerHTML = (
                        tampunghdd.innerHTML +
                        "<input type='hidden' name='REWARD[" + rewrdarr[i] + "]["+(bariskeReward - 1)+"]' value='" + objs.value + "' labelnya='reward_" + rewrdarr[i] + (bariskeReward - 1) + "' />"
                        );
            }
        }
        if (objs.getAttribute("modelinput") === "select") {
            var slcs = objs.tampung;
            var rsls = "";
            if (slcs.length > 0) {
                rsls = "<ul>" + rewrdarr[i] + " : ";
                for (var j = 0; j < slcs.length; j++) {
                    rsls = rsls + "<li>" + slcs[i] + "</li>";
                }
                rsls = rsls + "</ul>";
            }
            result = result + rsls;
            tampunghdd.innerHTML = (
                    tampunghdd.innerHTML +
                    "<input type='hidden' name='REWARD[" + rewrdarr[i] + "]["+(bariskeReward - 1)+"]' value='" + gethidden(slcs) + "' labelnya='reward_" + rewrdarr[i] + (bariskeReward - 1) + "' />"
                    );
        }
    }
    if (result !== "") {
        result = "<ul>" + result + "</ul>";
    }
    trbrss.innerHTML = result + '<font id="addreward' + bariskeReward + '" bariske="' + bariskeReward + '" style="color: blue; cursor: pointer;">Ganti Reward</font>';
    button_reward("addreward", bariskeReward, bariskeReward);
}

function refreshreward() {
    for (var i = 0; i < rewrdarr.length; i++) {
        var objs = document.getElementById("ID_" + rewrdarr[i] + "REWARD");
        if (objs.getAttribute("modelinput") === "text") {
            objs.value = "";
        }
        if (objs.getAttribute("modelinput") === "select") {
            var slcs = objs.tampung;
            if (slcs.length > 0) {
                setidforselect("ID_" + rewrdarr[i] + "REWARD");
                removeSelect('DIVS_' + rewrdarr[i] + (i + 1) + "REWARD", rewrdarr[i]);
            }
            objs.tampung = [];
        }
    }
}