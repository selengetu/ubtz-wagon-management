
<style>
    .btn-circle {
        width: 30px;
        height: 30px;
        padding: 6px 0px;
        border-radius: 30px;
        text-align: center;
        font-size: 12px;
        line-height: 1.42857;

    }

    .btn-circle2 {
        width: 50px;
        height: 50px;
        padding: 6px 0px;
        border-radius: 50%;
        text-align: center;
        font-size: 12px;
        line-height: 1.42857;

    }

    .card {
        height: 100%;
    }

    .pbb-caption {
        color: #fff;
        font-size: 22px;
        font-weight: 600;
        font-family: "Montserrat", Helvetica, Arial, sans-serif;
    }

    .question-panel {
        float: none;
        height: auto;
    }

    .qp-items {
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
       cursor: pointer;
    }

    .qp-item {
        display: inline-block;
        margin: 10px 4px 0 4px;
        float: left;
        width: 28px;
        height: 28px;
        line-height: 30px;
        font-size: 14px;
        font-weight: 700;
        border-radius: 50%;
        text-align: center;
        float: left;
        color: #84ae90;
        background-color: #245a34;
        color: #fff !important;
    }

    .qp-item.qp-item-unanswered {
        background-color: #32b3c7;
    }

    .qp-item.qp-item-correct {
        background-color: green;
    }

    .qp-item.qp-item-wrong {
        background-color: red;
    }

    .qp-item.qp-item-selected {
        background-color: #FFb404 !important;
    }

    .question-bt {
        margin-top: 15px;
        padding-left: 20px;
    }

    .question-bt span:before {
        content: "";
        position: absolute;
        width: 16px;
        height: 16px;
        background: #85d2de;
        left: 0;
        top: 1px;
        border-radius: 50%;
    }

    .question-bt span {
        font-family: Nunito;
        font-size: 14px;
        line-height: 2;
        text-align: center;
        color: #fff;
        padding-left: 24px;
        position: relative;
    }

    .question-bt span.answered:before {
        background: #00ff00;
    }

    .question-bt span.wrong:before {
        background: #ff000a;
    }

    .question-bt span.selected:before {
        background: #FFb404;
    }

    .rfc-right {
        margin-top: 50px;
    }

    .rfc-time {
        width: 100%;
        font-family: Nunito;
        font-size: 30px;
        font-weight: 600;
    }

    .progress-group {
        color: #fff;
        margin: 10px;
        padding: 5px;
    }

    .form-check-input {
        margin-left: 30px;
        margin-top: 35px;
        transform: scale(3);
    }

    .tgo-choice {
        border-radius: 6px;
        border: 2px solid #ededed;
        padding: 30px;
        width: 100%;
        transition: border .5s ease-out, background-color .5s ease-out;
        cursor: pointer;
    }

    .tgo-choice.tgo-correct {
        border: 2px solid green;
    }

    .tgo-choice.tgo-wrong {
        border: 2px solid red;
    }

    .tgo-choice div {
        margin-left: 50px;
    }

    input[type=checkbox]:checked+label, input[type=radio]:checked+label {
        background-color: #46a997;
        color: #fff;
    }
   
    .tgo-choice:hover {
        border-color: #32b3c7;
        box-shadow: 0 2px 8px 1px hsl(0deg 0% 66% / 20%);
    }

    span.clock {
        width: 30px;
        height: 30px;
        display: block;
        margin-top: 140px;
    }

    #stopwatch {
        color: #fff;
    }

    .examtime {
        margin-left: 30px;
    }

    .blurred {
        -webkit-filter: blur(3px)
    }

</style>

