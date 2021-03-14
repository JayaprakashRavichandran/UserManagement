<style>
    .container{
        width: 100%;
    }
    #header{
        text-align: center;
        background-color: #409ad5;
        color: white;
        padding: 1%;
    }
    #footer {
        margin: auto;
        text-align: center;
    }

    #footer input{
        background-color: #409ad5;
        color: white;
    }
    #create_users_container {
        margin: auto;
        justify-content: center;
        width: 50%;
    }
    #create_users_container #content {
        width: 100%;
        margin-top: 2%;
        margin-bottom: 2%;
        /*height: 50vh;*/
        height: auto;
    }
    .main_column{
        width: 100%;
        padding: 3%;
    }
    .sub_column{
        float: left;
        width: 50%;
    }
    .clear{
        width: 100%;
        /*padding: 1%;*/
    }
    .formInput-required {
        color: red;
        font-size: 12px;
        padding-left: 3px;
        font-weight: bold;
    }
    textarea {
        color: black;
    }
    .profileImg {
        width: 75%;
        margin: auto;
        text-align: center;
    }
    .uploaded_img {
        width: 30%;
    }
    .navbarContainer {
        background-color: black;
        width: 100%;
        margin: -8px -8px 0px;
    }
    .topnav{
        margin:0px 10px 10px;
        padding: 10px 8%;
        width: 100%;
    }
    .topnav a {
        margin-right: 25px;
        text-decoration: none;
        color: white;
    }
/*    List users css */
    .container{
        width: 100%;
    }
    .main-container{
        width: 80%;
        margin: auto;
        border: 1px solid black;
    }
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #129FEA;
        color: white;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    #table_search{
        border-bottom: 1px solid black;
        padding: 15px;
    }

</style>