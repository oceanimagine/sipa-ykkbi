/* ---------------------------------------------------------------------- */
/* Form Package Operator and Mandatory checked */

for (var i = 0; i < paramarr.length; i++) {
    if (document.getElementById("operatorlg" + paramarr[i])) {
        var id_operatorlg = document.getElementById("operatorlg" + paramarr[i]);
        var id_operatorlt = document.getElementById("operatorlt" + paramarr[i]);
        var id_operatorlgeq = document.getElementById("operatorlgeq" + paramarr[i]);
        var id_operatorlteq = document.getElementById("operatorlteq" + paramarr[i]);
        var id_operatoreq = document.getElementById("operatoreq" + paramarr[i]);
        id_operatorlg.inisial = paramarr[i];
        id_operatorlt.inisial = paramarr[i];
        id_operatorlgeq.inisial = paramarr[i];
        id_operatorlteq.inisial = paramarr[i];
        id_operatoreq.inisial = paramarr[i];
        operator[paramarr[i]] = "";
        if ($("#operatorlg" + paramarr[i]).is(':checked')) {
            operator[paramarr[i]] = "( - Lebih Besar - )";
        }
        if ($("#operatorlt" + paramarr[i]).is(':checked')) {
            operator[paramarr[i]] = "( - Lebih Kecil - )";
        }
        if ($("#operatorlgeq" + paramarr[i]).is(':checked')) {
            operator[paramarr[i]] = "( - Lebih Besar Sama dengan - )";
        }
        if ($("#operatorlteq" + paramarr[i]).is(':checked')) {
            operator[paramarr[i]] = "( - Lebih Kecil Sama dengan - )";
        }
        if ($("#operatoreq" + paramarr[i]).is(':checked')) {
            operator[paramarr[i]] = "( - Sama dengan - )";
        }
        $("#operatorlg" + paramarr[i]).on('ifChecked', function () {
            /* console.log("operatorlg" + this.inisial); */
            operator[this.inisial] = "( - Lebih Besar - )";
            if(typeof mandatorys === "object") {
                if(typeof textmndt[this.inisial] === "undefined"){
                    textmndt[this.inisial] = document.createTextNode("( - Lebih Besar - )");
                } else {
                    textmndt[this.inisial].parentNode.removeChild(textmndt[this.inisial]);
                    textmndt[this.inisial] = document.createTextNode("( - Lebih Besar - )");
                }
                if(typeof mdtrhidden === "object"){
                    mdtrhidden.value = "Lebih Besar";
                }
                mandatorys.appendChild(textmndt[this.inisial]);
            }
        });
        $("#operatorlt" + paramarr[i]).on('ifChecked', function () {
            /* console.log("operatorlt" + this.inisial); */
            operator[this.inisial] = "( - Lebih Kecil - )";
            if(typeof mandatorys === "object") {
                if(typeof textmndt[this.inisial] === "undefined"){
                    textmndt[this.inisial] = document.createTextNode("( - Lebih Kecil - )");
                } else {
                    textmndt[this.inisial].parentNode.removeChild(textmndt[this.inisial]);
                    textmndt[this.inisial] = document.createTextNode("( - Lebih Kecil - )");
                }
                if(typeof mdtrhidden === "object"){
                    mdtrhidden.value = "Lebih Kecil";
                }
                mandatorys.appendChild(textmndt[this.inisial]);
            }
        });
        $("#operatorlgeq" + paramarr[i]).on('ifChecked', function () {
            /* console.log("operatorlgeq" + this.inisial); */
            operator[this.inisial] = "( - Lebih Besar Sama dengan - )";
            if(typeof mandatorys === "object") {
                if(typeof textmndt[this.inisial] === "undefined"){
                    textmndt[this.inisial] = document.createTextNode("( - Lebih Besar Sama dengan - )");
                } else {
                    textmndt[this.inisial].parentNode.removeChild(textmndt[this.inisial]);
                    textmndt[this.inisial] = document.createTextNode("( - Lebih Besar Sama dengan - )");
                }
                if(typeof mdtrhidden === "object"){
                    mdtrhidden.value = "Lebih Besar Sama dengan";
                }
                mandatorys.appendChild(textmndt[this.inisial]);
            }
        });
        $("#operatorlteq" + paramarr[i]).on('ifChecked', function () {
            /* console.log("operatorlteq" + this.inisial); */
            operator[this.inisial] = "( - Lebih Kecil Sama dengan - )";
            if(typeof mandatorys === "object") {
                if(typeof textmndt[this.inisial] === "undefined"){
                    textmndt[this.inisial] = document.createTextNode("( - Lebih Kecil Sama dengan - )");
                } else {
                    textmndt[this.inisial].parentNode.removeChild(textmndt[this.inisial]);
                    textmndt[this.inisial] = document.createTextNode("( - Lebih Kecil Sama dengan - )");
                }
                if(typeof mdtrhidden === "object"){
                    mdtrhidden.value = "Lebih Kecil Sama dengan";
                }
                mandatorys.appendChild(textmndt[this.inisial]);
            }
        });
        $("#operatoreq" + paramarr[i]).on('ifChecked', function () {
            /* console.log("operatoreq" + this.inisial); */
            operator[this.inisial] = "( - Sama dengan - )";
            if(typeof mandatorys === "object") {
                if(typeof textmndt[this.inisial] === "undefined"){
                    textmndt[this.inisial] = document.createTextNode("( - Sama dengan - )");
                } else {
                    textmndt[this.inisial].parentNode.removeChild(textmndt[this.inisial]);
                    textmndt[this.inisial] = document.createTextNode("( - Sama dengan - )");
                }
                if(typeof mdtrhidden === "object"){
                    mdtrhidden.value = "Sama dengan";
                }
                mandatorys.appendChild(textmndt[this.inisial]);
            }
        });
    }

    if (document.getElementById("optional" + paramarr[i])) {
        var opsionals = document.getElementById("optional" + paramarr[i]);
        var mandatory = document.getElementById("mandatory" + paramarr[i]);
        opsionals.inisial = paramarr[i];
        mandatory.inisial = paramarr[i];
        opsional[paramarr[i]] = "";
        if ($("#optional" + paramarr[i]).is(':checked')) {
            opsional[paramarr[i]] = "( - Opsional - )";
        }
        if ($("#mandatory" + paramarr[i]).is(':checked')) {
            opsional[paramarr[i]] = "( - Mandatory - )";
        }
        $("#optional" + paramarr[i]).on('ifChecked', function () {
            /* console.log("optional" + this.inisial); */
            opsional[this.inisial] = "( - Opsional - )";
            if(typeof mandatorys === "object") {
                if(typeof textmndt[this.inisial] === "undefined"){
                    textmndt[this.inisial] = document.createTextNode("( - Opsional - )");
                } else {
                    textmndt[this.inisial].parentNode.removeChild(textmndt[this.inisial]);
                    textmndt[this.inisial] = document.createTextNode("( - Opsional - )");
                }
                if(typeof mdtrhidden === "object"){
                    mdtrhidden.value = "Opsional";
                }
                mandatorys.appendChild(textmndt[this.inisial]);
            }
        });
        $("#mandatory" + paramarr[i]).on('ifChecked', function () {
            /* console.log("mandatory" + this.inisial); */
            opsional[this.inisial] = "( - Mandatory - )";
            if(typeof mandatorys === "object") {
                if(typeof textmndt[this.inisial] === "undefined"){
                    textmndt[this.inisial] = document.createTextNode("( - Mandatory - )");
                } else {
                    textmndt[this.inisial].parentNode.removeChild(textmndt[this.inisial]);
                    textmndt[this.inisial] = document.createTextNode("( - Mandatory - )");
                }
                if(typeof mdtrhidden === "object"){
                    mdtrhidden.value = "Mandatory";
                }
                mandatorys.appendChild(textmndt[this.inisial]);
            }
        });
    }
}