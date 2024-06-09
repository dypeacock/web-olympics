//let iso_id_validation = false;

function showResults(){
    var x = document.getElementById("results");
    if (x.style.display === "none") {
        x.style.display = "block";
    }
}

function checkISO(){
    let ISO_1 = $("#iso_1").val().trim();
    let ISO_2 = $("#iso_2").val().trim();

    if (ISO_1 === "" && ISO_2 === ""){
        alert("Please enter Country ID values!");
    } else if (ISO_1 === "" || ISO_2 === ""){
        alert("Please fill out both Country ID values!");
    } else {
        $.ajax({
            url: "submit.php",
            type: "GET",
            data: { country_1: ISO_1, country_2 : ISO_2 },
            success: function (responseData) {
                var response = JSON.parse(responseData);
                let len = response.length;
                
                if (len == 0){ //neither isoID's were correct 
                    alert("Neither "+ISO_1+" nor "+ISO_2+" are valid country ID's!\nPlease try again!");
                } else if (len == 1){ //one isoID was incorrect
                    let correct_iso_id = response[0].iso_id; 
                    if (correct_iso_id == ISO_1){
                        alert(ISO_2+" is not a valid country ID!\nPlease try again!");
                    } else {
                        alert(ISO_1+" is not a valid country ID!\nPlease try again!");
                    }
    
                } else { //both isoID's were correct
                    
                    showMedalTables();
                    showCyclistList();
                    showGold();
                    showNumberOfCyclists();
                    averageAge();
                    addSearchFilter();
                    showResults();
                    //iso_id_validation = true;
                }
            },
            error: function (e) {
                console.log(e.message);
            }
        });
    }
}


function showMedalTables(){
    let ISO_1 = $("#iso_1").val();
    let ISO_2 = $("#iso_2").val();
    $.ajax({
        url: "medals.php",
        type: "GET",
        data: { country_1: ISO_1, country_2 : ISO_2 },
        success: function (responseData) {
            var response = JSON.parse(responseData);
            
            let len = response.length;
            let insertedHtml = "<table> <tr class='non-iso'><td> Country </td><td> Gold </td><td> Silver </td><td> Bronze </td><td> Total </td></tr>";

            for(let i=0; i<len; i++){
                let iso_id = response[i].iso_id;
                let gold = response[i].gold;
                let silver = response[i].silver;
                let bronze = response[i].bronze;
                let total = response[i].total;
                insertedHtml += "<tr class='non-iso'><td>"+iso_id+"</td><td>"+gold+"</td><td>"+silver+"</td><td>"+bronze+"</td><td>"+total+"</td></tr>";
            }
            insertedHtml += "</table>";
            
            $("#medals").html(insertedHtml);
        },
        
        error: function (e) {
            console.log(e.message);
        }
    });
}

function showCyclistList(){
    let ISO_1 = $("#iso_1").val();
    let ISO_2 = $("#iso_2").val();
    $.ajax({
        url: "cyclists1.php",
        type: "GET",
        data: { country_1: ISO_1},
        success: function (responseData) {
            var response = JSON.parse(responseData);
            
            let len = response.length;
            let insertedHtml = "";
            if (len == 0){
                insertedHtml += "<p>'"+ISO_1+"' is not a correct Country ID : Please try again!</p>";
            } else {
                insertedHtml += "<h2>"+ISO_1+"</h2><ul>";
                for(let i=0; i<len; i++){
                    let name = response[i].name;
                    insertedHtml += "<li>"+name;
                }
                insertedHtml += "</ul>";
            }
            
            $("#cyclists1").html(insertedHtml);
        },
        
        error: function (e) {
            console.log(e.message);
        }
    });

    $.ajax({
        url: "cyclists2.php",
        type: "GET",
        data: { country_2 : ISO_2 },
        success: function (responseData) {
            var response = JSON.parse(responseData);

            let len = response.length;
            let insertedHtml = "";
            if (len == 0){
                insertedHtml += "<p>'"+ISO_2+"' is not a correct Country ID : Please try again!</p>";
            } else {
                insertedHtml += "<h2>"+ISO_2+"</h2><ul>";
                for(let i=0; i<len; i++){
                    let name = response[i].name;
                    insertedHtml += "<li>"+name;
                }
                insertedHtml += "</ul>";
            }

            $("#cyclists2").html(insertedHtml);
        },
        
        error: function (e) {
            console.log(e.message);
        }
    });
}

function showGold(){
    let ISO_1 = $("#iso_1").val();
    let ISO_2 = $("#iso_2").val();
    $.ajax({
        url: "gold.php",
        type: "GET",
        //data: { country_2 : ISO_2 },
        success: function (responseData) {
            var response = JSON.parse(responseData);

            let len = response.length;
            let insertedHtml = "";
            
            insertedHtml += "<table> <tr class='non-iso'><td> Rank </td><td> Country </td><td> Gold </td></tr>";

            let pos=1;
            let medal_nb = response[0].gold;

            for (let i=0; i<len; i++){
                
                if (response[i].gold != medal_nb){
                    medal_nb = response[i].gold;
                    pos +=1;
                }

                if (response[i].iso_id == ISO_1 || response[i].iso_id == ISO_2){
                    insertedHtml += "<tr class='iso-row'><td>"+pos+"</td><td>"+response[i].iso_id+"</td><td>"+response[i].gold+"</td></tr>";
                } else {
                    insertedHtml += "<tr class='non-iso'><td>"+pos+"</td><td>"+response[i].iso_id+"</td><td>"+response[i].gold+"</td></tr>";
                }
            }

            insertedHtml += "</table>";            
            $("#gold").html(insertedHtml);
        },
        
        error: function (e) {
            console.log(e.message);
        }
    });
}

function showNumberOfCyclists(){
    let ISO_1 = $("#iso_1").val();
    let ISO_2 = $("#iso_2").val();
    $.ajax({
        url: "number_of_cyclists.php",
        type: "GET",
        //data: { country_2 : ISO_2 },
        success: function (responseData) {
            var response = JSON.parse(responseData);
            //console.log(response);

            let len = response.length;
            let insertedHtml = "";
            
            insertedHtml += "<table> <tr class='non-iso'><td> Rank </td><td> Country </td><td> Number of cyclists </td></tr>";

            let pos = 1;
            let cyclist_nb = response[0].number_of_cyclists;

            for (let i=0; i<len; i++){

                if (response[i].number_of_cyclists != cyclist_nb){
                    pos += 1;
                    cyclist_nb = response[i].number_of_cyclists;
                }

                if (response[i].iso_id == ISO_1 || response[i].iso_id == ISO_2){
                    insertedHtml += "<tr class='iso-row'><td>"+pos+"</td><td>"+response[i].iso_id+"</td><td>"+response[i].number_of_cyclists+"</td></tr>";
                } else {
                    insertedHtml += "<tr class='non-iso'><td>"+pos+"</td><td>"+response[i].iso_id+"</td><td>"+response[i].number_of_cyclists+"</td></tr>";
                }
            }

            insertedHtml += "</table>";            
            $("#number_of_cyclists").html(insertedHtml);
        },
        
        error: function (e) {
            console.log(e.message);
        }
    });
}

function averageAge(){
    let ISO_1 = $("#iso_1").val();
    let ISO_2 = $("#iso_2").val();
    $.ajax({
        url: "avg_age.php",
        type: "GET",
        //data: { country_2 : ISO_2 },
        success: function (responseData) {
            var response = JSON.parse(responseData);
            //console.log(response);

            let len = response.length;
            let insertedHtml = "";
            
            insertedHtml += "<table> <tr class='non-iso'><td> Rank </td><td> Country </td><td> Average age </td></tr>";

            let pos = 1;
            let age_val = response[0].avg_age;

            for (let i=0; i<len; i++){

                if (response[i].avg_age != age_val){
                    pos += 1;
                    age_val = response[i].avg_age;
                }

                if (response[i].iso_id == ISO_1 || response[i].iso_id == ISO_2){
                    insertedHtml += "<tr class='iso-row'><td>"+pos+"</td><td>"+response[i].iso_id+"</td><td>"+response[i].avg_age+"</td></tr>";
                } else {
                    insertedHtml += "<tr class='non-iso'><td>"+pos+"</td><td>"+response[i].iso_id+"</td><td>"+response[i].avg_age+"</td></tr>";
                }
            }

            insertedHtml += "</table>";            
            $("#avg_age").html(insertedHtml);
        },
        
        error: function (e) {
            console.log(e.message);
        }
    });
}

function addSearchFilter(){
    let insertedHtml = "<a class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Filter Search</a>";
    insertedHtml += "<ul class='dropdown-menu'>";
    insertedHtml += "<li><a class='dropdown-item' href='#gold'>Gold Medals</a></li>";
    insertedHtml += "<li><a class='dropdown-item' href='#number_of_cyclists'>Number of Cyclists</a></li>";
    insertedHtml += "<li><a class='dropdown-item' href='#avg_age'>Average Age</a></li></ul>";
    $("#filter-dropdown").html(insertedHtml);
}

/*
$(document).ready(function () {
    $("#COUNTRY_ISO").submit(function (event) {
        let insertedHtml = "<table border='1'>";
        insertedHtml += "<tr><th scope='col'>Key</th><th scope='col'>Value</th></tr>";
        insertedHtml += "<tr><td><label for='iso_1'>Country ID 1 (iso_id)</label></td><td><input name='iso_1' type='text' class='larger' id='iso_1' value='GBR' size='12' /></td></tr>";
        insertedHtml += "<tr><td><label for='iso_2'>Country ID 2 (iso_id)</label></td><td><input name='iso_2' type='text' class='larger' id='iso_2' value='FRA' size='12' /></td></tr>";
        insertedHtml += "<tr><td>Compare both</td><td><input type='submit' id='submit' class='larger'></td></tr>";
        insertedHtml += "<tr><td>Compare both v2</td><td><select name='comparison' id='comparison'><option value='compare1'>Compare1</option><option value='compare2'>Compare2</option><option value='compare3'>Compare3</option></select></td></tr>";
        insertedHtml += "</table>"
        $("#COUNTRY_ISO").html(insertedHtml);

    });
});
*/

/*
$(document).ready(function () {
    $("#COUNTRY_ISO").submit(function (event) {
        let ISO_1 = $("#iso_1").val();
        let ISO_2 = $("#iso_2").val();
        //console.log(ISO_1, ISO_2);
        //debugger;
        $.ajax({
            url: "medals.php",
            type: "GET",
            data: { country_1: ISO_1, country_2 : ISO_2 },
            success: function (responseData) {
                var response = JSON.parse(responseData);
                console.log(response);
                
                let len = response.length;
                let insertedHtml = "";
                if (len == 0){ //neither ISO_ID's were correct
                    insertedHtml += "<p>NO RESULTS</p>";
                } else if (len == 1){
                    let correct_iso_id = response[0].iso_id; 
                    //console.log(correct_iso_id==ISO_2);
                    if (correct_iso_id == ISO_1){
                        insertedHtml += "<p>'"+ISO_2+"' is not a correct Country ID : Please try again!</p>";
                    } else {
                        insertedHtml += "<p>'"+ISO_1+"' is not a correct Country ID : Please try again!</p>";
                    }

                } else { //both ISO_ID's were correct
                    insertedHtml += "<table> <tr><td> Country </td><td> Gold </td><td> Silver </td><td> Bronze </td><td> Total </td></tr>";
                
                    for(let i=0; i<len; i++){
                        let iso_id = response[i].iso_id;
                        let gold = response[i].gold;
                        let silver = response[i].silver;
                        let bronze = response[i].bronze;
                        let total = response[i].total;
                        insertedHtml += "<tr><td>"+iso_id+"</td><td>"+gold+"</td>><td>"+silver+"</td>><td>"+bronze+"</td>><td>"+total+"</td></tr>";
                    }
                    insertedHtml += "</table>";
                }
                
                $("#medals").html(insertedHtml);
            },
            
            error: function (e) {
                console.log(e.message);
            }
        })
        event.preventDefault();
    });
});

$(document).ready(function () {
    $("#COUNTRY_ISO").submit(function (event) {
        let ISO_1 = $("#iso_1").val();
        $.ajax({
            url: "cyclists1.php",
            type: "GET",
            data: { country_1: ISO_1},
            success: function (responseData) {
                var response = JSON.parse(responseData);
                console.log(response);
                
                let len = response.length;
                let insertedHtml = "";
                if (len == 0){
                    insertedHtml += "<p>'"+ISO_1+"' is not a correct Country ID : Please try again!</p>";
                } else {
                    insertedHtml += "<h2>"+ISO_1+"</h2><ul>";
                    for(let i=0; i<len; i++){
                        let name = response[i].name;
                        insertedHtml += "<li>"+name;
                    }
                    insertedHtml += "</ul>";
                }
                
                $("#cyclists1").html(insertedHtml);
            },
            
            error: function (e) {
                console.log(e.message);
            }
        })
        event.preventDefault();
    });
});

$(document).ready(function () {
    $("#COUNTRY_ISO").submit(function (event) {
        let ISO_2 = $("#iso_2").val();
        $.ajax({
            url: "cyclists2.php",
            type: "GET",
            data: { country_2 : ISO_2 },
            success: function (responseData) {
                var response = JSON.parse(responseData);
                console.log(response);
                
                let len = response.length;
                let insertedHtml = "";
                if (len == 0){
                    insertedHtml += "<p>'"+ISO_2+"' is not a correct Country ID : Please try again!</p>";
                } else {
                    insertedHtml += "<h2>"+ISO_2+"</h2><ul>";
                    for(let i=0; i<len; i++){
                        let name = response[i].name;
                        insertedHtml += "<li>"+name;
                    }
                    insertedHtml += "</ul>";
                }

                $("#cyclists2").html(insertedHtml);
            },
            
            error: function (e) {
                console.log(e.message);
            }
        })
        event.preventDefault();
    });
});
*/