<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->

    <style type="text/css">
        :root #header+#content>#left>#rlblock_left {
            display: none !important;
        }
    </style>

    <style type="text/css">
        .jstree ul,
        .jstree li {
            display: block;
            margin: 0 0 0 0;
            padding: 0 0 0 0;
            list-style-type: none;
        }

        .jstree li {
            display: block;
            min-height: 24px;
            line-height: 24px;
            white-space: nowrap;
            margin-left: 18px;
        }

        .jstree-rtl li {
            margin-left: 0;
            margin-right: 18px;
        }

        .jstree>ul>li {
            margin-left: 0px;
        }

        .jstree-rtl>ul>li {
            margin-right: 0px;
        }

        .jstree ins {
            display: inline-block;
            text-decoration: none;
            width: 18px;
            height: 18px;
            margin: 0 0 0 0;
            padding: 0;
        }

        .jstree a {
            display: inline-block;
            line-height: 16px;
            height: 16px;
            color: black;
            white-space: nowrap;
            text-decoration: none;
            padding: 1px 2px;
            margin: 0;
        }

        .jstree a:focus {
            outline: none;
        }

        .jstree a>ins {
            height: 16px;
            width: 16px;
        }

        .jstree a>.jstree-icon {
            margin-right: 3px;
        }

        .jstree-rtl a>.jstree-icon {
            margin-left: 3px;
            margin-right: 0;
        }

        li.jstree-open>ul {
            display: block;
        }

        li.jstree-closed>ul {
            display: none;
        }
    </style>

    <style type="text/css">
        #vakata-dragged {
            display: block;
            margin: 0 0 0 0;
            padding: 4px 4px 4px 24px;
            position: absolute;
            top: -2000px;
            line-height: 16px;
            z-index: 10000;
        }
    </style>

    <style type="text/css">
        #vakata-dragged ins {
            display: block;
            text-decoration: none;
            width: 16px;
            height: 16px;
            margin: 0 0 0 0;
            padding: 0;
            position: absolute;
            top: 4px;
            left: 4px;
        }

        #vakata-dragged .jstree-ok {
            background: green;
        }

        #vakata-dragged .jstree-invalid {
            background: red;
        }

        #jstree-marker {
            padding: 0;
            margin: 0;
            line-height: 12px;
            font-size: 1px;
            overflow: hidden;
            height: 12px;
            width: 8px;
            position: absolute;
            top: -30px;
            z-index: 10000;
            background-repeat: no-repeat;
            display: none;
            background-color: silver;
        }
    </style>

    <style type="text/css">
        #vakata-contextmenu {
            display: none;
            position: absolute;
            margin: 0;
            padding: 0;
            min-width: 180px;
            background: #ebebeb;
            border: 1px solid silver;
            z-index: 10000;
            *width: 180px;
        }

        #vakata-contextmenu ul {
            min-width: 180px;
            *width: 180px;
        }

        #vakata-contextmenu ul,
        #vakata-contextmenu li {
            margin: 0;
            padding: 0;
            list-style-type: none;
            display: block;
        }

        #vakata-contextmenu li {
            line-height: 20px;
            min-height: 20px;
            position: relative;
            padding: 0px;
        }

        #vakata-contextmenu li a {
            padding: 1px 6px;
            line-height: 17px;
            display: block;
            text-decoration: none;
            margin: 1px 1px 0 1px;
        }

        #vakata-contextmenu li ins {
            float: left;
            width: 16px;
            height: 16px;
            text-decoration: none;
            margin-right: 2px;
        }

        #vakata-contextmenu li a:hover,
        #vakata-contextmenu li.vakata-hover>a {
            background: gray;
            color: white;
        }

        #vakata-contextmenu li ul {
            display: none;
            position: absolute;
            top: -2px;
            left: 100%;
            background: #ebebeb;
            border: 1px solid gray;
        }

        #vakata-contextmenu .right {
            right: 100%;
            left: auto;
        }

        #vakata-contextmenu .bottom {
            bottom: -1px;
            top: auto;
        }

        #vakata-contextmenu li.vakata-separator {
            min-height: 0;
            height: 1px;
            line-height: 1px;
            font-size: 1px;
            overflow: hidden;
            margin: 0 2px;
            background: silver;
            /* border-top:1px solid #fefefe; */
            padding: 0;
        }
    </style>

    <style type="text/css">
        .jstree .ui-icon {
            overflow: visible;
        }

        .jstree a {
            padding: 0 2px;
        }
    </style>

</head>
<body>


    <div id="t_content" class="ui-corner-all" style="height: 380px;">

                        <input type="hidden" id="test_type" value="2">
                        <input type="hidden" id="action" value="enter_question">

                        <div class="wrapper_valign_container">
                            <div class="valign_container">

                                <div class="question_panel ui-corner-all" style="z-index: 1; height: 1px; width: 633px;">

                                    <p style="text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 8px 0px;">
                                        <span style=" font-size: 10pt; font-family: &#39;Verdana&#39;, &#39;Geneva&#39;, sans-serif; font-style: normal; font-weight: bold; color: #333399; background-color: transparent; text-decoration: none;">
                                            Тип вопроса "Выбор одного варианта ответа". Пример:
                                        </span>
                                    </p>

                                    <p style="text-align: justify; text-indent: 0px; line-height: 1.15; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
                                        <span style=" font-size: 10pt; font-family: &#39;Verdana&#39;, &#39;Geneva&#39;, sans-serif; font-style: normal; font-weight: normal; color: #000000; background-color: transparent; text-decoration: none;">
                                            Основоположник античной диалектики, автор слов "В одну реку нельзя войти дважды"?
                                        </span>
                                    </p>
                                    
                                    <br>

                                    <div class="prompt" position="1">
                                        <div class="prompt_button" style="cursor: pointer;">Пояснение <span style="float:right"
                                                class="ui-icon ui-icon-carat-1-s"></span></div>
                                        <div class="prompt_panel" style="display: none;">
                                            <p style="text-align: justify; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;"><span
                                                    style=" font-size: 10pt; font-family: &#39;Verdana&#39;, &#39;Geneva&#39;, sans-serif; font-style: normal; font-weight: normal; color: #000000; background-color: transparent; text-decoration: none;">К
                                                    вопросам может добавляться "Пояснение" с произвольным содержимым.
                                                    Пояснения могут выводиться в разных случаях в зависимости от
                                                    заданных настроек:</span></p>
                                            <p style="text-align: justify; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;"><span
                                                    style=" font-size: 10pt; font-family: &#39;Verdana&#39;, &#39;Geneva&#39;, sans-serif; font-style: normal; font-weight: normal; color: #000000; background-color: transparent; text-decoration: none;">1.
                                                    При нажатии на кнопку "Пояснение".</span></p>
                                            <p style="text-align: justify; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;"><span
                                                    style=" font-size: 10pt; font-family: &#39;Verdana&#39;, &#39;Geneva&#39;, sans-serif; font-style: normal; font-weight: normal; color: #000000; background-color: transparent; text-decoration: none;">2.
                                                    При неправильном ответе.</span></p>
                                            <p style="text-align: justify; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;"><span
                                                    style=" font-size: 10pt; font-family: &#39;Verdana&#39;, &#39;Geneva&#39;, sans-serif; font-style: normal; font-weight: normal; color: #000000; background-color: transparent; text-decoration: none;">3.
                                                    При просмотре ошибок в ответах после завершения тестирования.</span></p>
                                        </div>
                                    </div>
                                    <br>
                                    <form class="answer_form">
                                        <table class="t-rc">

                                            <tbody>
                                                <tr>
                                                    <td class="rc">
                                                        <div class="radio" id="uniform-cid_2e9acb6d6ad5b9dd469c9bcd81d4d135"><span><input
                                                                    type="radio" id="cid_2e9acb6d6ad5b9dd469c9bcd81d4d135"
                                                                    name="uid_f755853856101f0a6ccea76f435ba3df"
                                                                    position="1" res_answer_id="675" style="opacity: 0;"></span></div>
                                                    </td>
                                                    <td><label for="cid_2e9acb6d6ad5b9dd469c9bcd81d4d135">Протагор</label></td>
                                                </tr>

                                                <tr>
                                                    <td class="rc">
                                                        <div class="radio" id="uniform-cid_010c0290e7c0dab5fb7142548d46a8a0"><span><input
                                                                    type="radio" id="cid_010c0290e7c0dab5fb7142548d46a8a0"
                                                                    name="uid_f755853856101f0a6ccea76f435ba3df"
                                                                    position="1" res_answer_id="676" style="opacity: 0;"></span></div>
                                                    </td>
                                                    <td><label for="cid_010c0290e7c0dab5fb7142548d46a8a0">Платон</label></td>
                                                </tr>

                                                <tr>
                                                    <td class="rc">
                                                        <div class="radio" id="uniform-cid_f352d29c1aa6c2a613bf307f0156a4a3"><span><input
                                                                    type="radio" id="cid_f352d29c1aa6c2a613bf307f0156a4a3"
                                                                    name="uid_f755853856101f0a6ccea76f435ba3df"
                                                                    position="1" res_answer_id="677" style="opacity: 0;"></span></div>
                                                    </td>
                                                    <td><label for="cid_f352d29c1aa6c2a613bf307f0156a4a3">Гераклит</label></td>
                                                </tr>

                                                <tr>
                                                    <td class="rc">
                                                        <div class="radio" id="uniform-cid_16f60d96569add70a0a27d94abb18e1b"><span><input
                                                                    type="radio" id="cid_16f60d96569add70a0a27d94abb18e1b"
                                                                    name="uid_f755853856101f0a6ccea76f435ba3df"
                                                                    position="1" res_answer_id="678" style="opacity: 0;"></span></div>
                                                    </td>
                                                    <td><label for="cid_16f60d96569add70a0a27d94abb18e1b">Фалес</label></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
  


    <!-- end -->
    <!-- - -->
    <!-- - -->
    <!-- - -->
    <!-- - -->
    <!-- - -->

    <div id="ext-comp-1014" class=" x-panel x-border-panel x-panel-noborder" style="left: 195px; top: 0px; width: 500px;">

        <div class="x-panel-bwrap" id="ext-gen49">

            <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen50" style="overflow: auto; width: 500px; height: 3 45px;">

                <div id="quiz-title-ext-gen26" class=" x-panel quiz-item-container-panel x-panel-noborder x-hide-display" style="margin: 10px 30px 10px 10px; padding: 0px; width: auto;">
                    <div class="x-panel-bwrap" id="ext-gen57">
                        <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen58" style="padding: 0px; width: auto; height: auto;">
                            <div id="ext-comp-1022" class=" x-panel quiz-item-panel x-panel-noborder x-panel-collapsed" style="margin: 10px;">
                                <div class="x-panel-bwrap" id="ext-gen59" style="display: none;">
                                    <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen60">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                <!--need -->
                <div id="ext-comp-1019" class=" x-panel master-quiz-panel x-panel-noborder ">

                    <div class="x-panel-bwrap" id="ext-gen61">

                        <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen62" style="height: auto;">

                            <div id="quiz-item-1-ext-gen33" class=" x-panel quiz-item-container-panel x-panel-noborder" style="margin-right: 20px; width: auto;">

                                <div class="x-panel-bwrap" id="ext-gen90">

                                    <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen91" style="width: auto; height: auto; visibility: visible;">

                                        <div id="ext-comp-1023" class=" x-plain master-question-panel quiz-item-panel x-plain-noborder" style="width: auto;">
                                                
                                            <h3 class="master-question-title x-plain-header-noborder x-unselectable" id="ext-gen92">
                                                <span class="question-number" id="ext-gen96"> </span>
                                                Питання1
                                            </h3>

                                            <div class="x-plain-bwrap" id="ext-gen93">

                                                <div class="x-plain-body x-plain-body-noborder" id="ext-gen94" style="width: auto; height: auto;">

                                                    <div id="ext-comp-1024" class=" x-panel x-panel-noborder">

                                                        <div class="x-panel-bwrap" id="ext-gen97">
                                                            <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen98" style="height: auto;">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div id="ext-comp-1025" class=" x-panel x-panel-noborder">
                                                        <div class="x-panel-bwrap" id="ext-gen99">
                                                            <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen100" style="height: auto;">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="ext-comp-1026" class=" x-panel x-panel-noborder">

                                                        <div class="x-panel-bwrap" id="ext-gen101">

                                                            <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen102" style="height: auto;">

                                                                <div id="ext-comp-1027" class=" x-panel x-panel-noborder" style="width: auto;">

                                                                    <div class="x-panel-bwrap"  id="ext-gen103">

                                                                        <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen104" style="width: auto; height: auto;">

                                                                            <div class="x-form-item  x-hide-label" tabindex="-1">

                                                                                <label for="ext-comp-1057" style="width:100px;"class="x-form-item-label"></label>

                                                                                <div class="x-form-element" id="x-form-el-ext-comp-1057" style="padding-left:105px">

                                                                                    <div class="x-form-check-wrap" id="ext-gen105" style="height: auto;">

                                                                                        <input type="radio" autocomplete="off" id="ext-comp-1057" name="question_answer_1" class=" x-form-radio x-form-field" value="1">                                                             
                                                                                        <label  for="ext-comp-1057" class="x-form-cb-label" id="ext-gen106">Відповіть1</label>

                                                                                    </div>

                                                                                </div>

                                                                                <div class="x-form-clear-left"></div>

                                                                            </div>

                                                                            <div class="x-form-item  x-hide-label" tabindex="-1">

                                                                                <label for="ext-comp-1058" style="width:100px;" class="x-form-item-label"></label>

                                                                                <div class="x-form-element" id="x-form-el-ext-comp-1058" style="padding-left:105px">

                                                                                    <div class="x-form-check-wrap" id="ext-gen107" style="height: auto;">
                                                                                        
                                                                                        <input type="radio" autocomplete="off"  id="ext-comp-1058" name="question_answer_1" class=" x-form-radio x-form-field" value="2">
                                                                                        <label  for="ext-comp-1058" class="x-form-cb-label" id="ext-gen108">Відповіть2</label>

                                                                                    </div>

                                                                                </div>

                                                                                <div class="x-form-clear-left"> </div>

                                                                            </div>

                                                                            <div class="x-form-item  x-hide-label" tabindex="-1">

                                                                                <label for="ext-comp-1059" style="width:100px;" class="x-form-item-label"></label>

                                                                                <div class="x-form-element"  id="x-form-el-ext-comp-1059"  style="padding-left:105px">

                                                                                    <div class="x-form-check-wrap" id="ext-gen109"  style="height: auto;">

                                                                                            <input type="radio" autocomplete="off" id="ext-comp-1059" name="question_answer_1" class=" x-form-radio x-form-field" value="3">
                                                                                            <label for="ext-comp-1059" class="x-form-cb-label" id="ext-gen110">Відповіть3</label>
                                                                                            
                                                                                    </div>

                                                                                </div> 

                                                                                <div class="x-form-clear-left"></div>

                                                                            </div>

                                                                            <div class="x-form-item  x-hide-label"  tabindex="-1">

                                                                                <label for="ext-comp-1060"  style="width:100px;" class="x-form-item-label"></label>

                                                                                <div class="x-form-element" id="x-form-el-ext-comp-1060" style="padding-left:105px">
                                                                                    <div class="x-form-check-wrap" id="ext-gen111" style="height: auto;">
                                                                                        
                                                                                        <input type="radio" autocomplete="off" id="ext-comp-1060" name="question_answer_1" class=" x-form-radio x-form-field" value="4">
                                                                                        <label for="ext-comp-1060" class="x-form-cb-label" id="ext-gen112">Відповіть4</label>

                                                                                    </div>
                                                                                </div> 

                                                                                <div class="x-form-clear-left"></div>

                                                                            </div> 

                                                                            <div class="x-form-item  x-hide-label" tabindex="-1">

                                                                                <label for="ext-comp-1061" style="width:100px;"  class="x-form-item-label"></label>

                                                                                <div class="x-form-element" id="x-form-el-ext-comp-1061" style="padding-left:105px">

                                                                                    <div class="x-form-check-wrap" id="ext-gen113" style="height: auto;">
                                                                                    
                                                                                        <input type="radio" autocomplete="off" id="ext-comp-1061" name="question_answer_1" class=" x-form-radio x-form-field" value="5">
                                                                                        <label for="ext-comp-1061" class="x-form-cb-label" id="ext-gen114">Відповіть5</label>

                                                                                    </div>

                                                                                </div>

                                                                                <div class="x-form-clear-left"></div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                <!--need -->


            </div>


            <div class="MYCLASS" id="ididiidid" style="background: red; width: 100; height: 100px;"> </div>

            
            <!-- good  -->
            <div class="x-panel-bbar x-panel-bbar-noborder" id="ext-gen51" style="background: blue; width: 500px;">
                <div id="ext-comp-1013" class="x-toolbar x-small-editor x-toolbar-layout-ct" style="height: 31px; width: 496px;">
                    <table cellspacing="0" class="x-toolbar-ct">

                        <tbody>

                            <tr>

                                <td class="x-toolbar-left" align="left">
                                    <table cellspacing="0">
                                        <tbody>

                                            <tr class="x-toolbar-left-row">
                                                
                                                <td class="x-toolbar-cell" id="ext-gen63">

                                                    <table cellspacing="0" class="x-btn  x-btn-text-icon " id="ext-comp-1016" style="height: 30px; width: auto;">

                                                        <tbody class="x-btn-small x-btn-icon-small-left">

                                                            <tr>
                                                                <td class="x-btn-tl"><i>&nbsp;</i></td>
                                                                <td class="x-btn-tc"></td>
                                                                <td class="x-btn-tr"><i>&nbsp;</i></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="x-btn-ml"><i>&nbsp;</i></td>
                                                                <td class="x-btn-mc"> 
                                                                    <em class="" unselectable="on"> 
                                                                        <button  class="x-btn-text icon-arrow_left" type="button" id="ext-gen65">Предыдущее</button>
                                                                    </em>   
                                                                </td>
                                                        
                                                                <td class="x-btn-mr"><i>&nbsp;</i></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="x-btn-bl"><i>&nbsp;</i></td>
                                                                <td class="x-btn-bc"></td>
                                                                <td class="x-btn-br"><i>&nbsp;</i></td>
                                                            </tr>

                                                        </tbody>

                                                    </table>

                                                </td>

                                                <td class="x-toolbar-cell" id="ext-gen66">
                                                    <span  class="xtb-sep" id="ext-gen67"></span>
                                                </td>

                                                <td class="x-toolbar-cell" id="ext-gen68">

                                                    <table cellspacing="0" class="x-btn  x-btn-text-icon" id="ext-comp-1015" style="height: 30px; width: auto;">

                                                        <tbody class="x-btn-small x-btn-icon-small-right">

                                                            <tr>
                                                                <td class="x-btn-tl"><i>&nbsp;</i></td>
                                                                <td class="x-btn-tc"></td>
                                                                <td class="x-btn-tr"><i>&nbsp;</i></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="x-btn-ml"><i>&nbsp;</i></td>

                                                                <td class="x-btn-mc">
                                                                    <em class="" unselectable="on">
                                                                        <button class="x-btn-text icon-arrow_right" type="button"  id="ext-gen70">Далее</button>
                                                                    </em>
                                                                </td>

                                                                <td class="x-btn-mr"><i>&nbsp;</i></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="x-btn-bl"><i>&nbsp;</i></td>
                                                                <td class="x-btn-bc"></td>
                                                                <td class="x-btn-br"><i>&nbsp;</i></td>
                                                            </tr>

                                                        </tbody>

                                                    </table>

                                                </td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </td>

                                <td class="x-toolbar-right" align="right">

                                    <table cellspacing="0" class="x-toolbar-right-ct">

                                        <tbody>

                                            <tr>

                                                <td>

                                                    <table cellspacing="0">

                                                        <tbody>

                                                            <tr class="x-toolbar-right-row">

                                                                <td class="x-toolbar-cell x-hide-display"  id="ext-gen71">

                                                                    <div id="quiz-timer-ext-gen24"  class=" x-panel"  style="width: 50px;">
                                                                        <div class="x-panel-bwrap"id="ext-gen72">
                                                                            <div  class="x-panel-body x-panel-body-noheader"  id="ext-gen73" style="width: 48px; height: 18px;"></div>
                                                                        </div>
                                                                    </div>

                                                                </td>

                                                                <td class="x-toolbar-cell" id="ext-gen74">
                                                                    <span  class="xtb-sep" id="ext-gen75"></span>
                                                                </td>

                                                                <td class="x-toolbar-cell" id="ext-gen76">

                                                                    <table cellspacing="0"  class="x-btn  x-btn-text-icon" id="ext-comp-1008" style="height: 30px; width: auto;">

                                                                        <tbody class="x-btn-small x-btn-icon-small-left">

                                                                            <tr>
                                                                                <td class="x-btn-tl"><i>&nbsp;</i></td>
                                                                                <td class="x-btn-tc"></td>
                                                                                <td class="x-btn-tr"><i>&nbsp;</i></td>
                                                                            </tr>

                                                                            <tr>

                                                                                <td class="x-btn-ml"><i>&nbsp;</i></td>

                                                                                <td class="x-btn-mc">
                                                                                    <em class="" unselectable="on">
                                                                                        <button  class="x-btn-text icon-tick"  type="button"  id="ext-gen78" name="finish_button">Закончить</button>
                                                                                    </em>
                                                                                </td>

                                                                                <td class="x-btn-mr"><i>&nbsp;</i></td>

                                                                            </tr>

                                                                            <tr>
                                                                                <td class="x-btn-bl"><i>&nbsp;</i></td>
                                                                                <td class="x-btn-bc"></td>
                                                                                <td class="x-btn-br"><i>&nbsp;</i></td>
                                                                            </tr>

                                                                        </tbody>

                                                                    </table>

                                                                </td>

                                                            </tr>

                                                        </tbody>

                                                    </table>

                                                </td>

                                                <td>

                                                    <table cellspacing="0">
                                                        <tbody>
                                                            <tr class="x-toolbar-extras-row"></tr>
                                                        </tbody>
                                                    </table>

                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </td>

                            </tr>

                        </tbody>

                    </table>
                </div>
            </div>
            <!-- good  -->

        </div>

    </div>

    <!-- - -->
    <!-- - -->
    <!-- - -->
    <!-- end -->

    <div id="ext-comp-1019" class=" x-panel master-quiz-panel x-panel-noborder ">

        <div class="x-panel-bwrap" id="ext-gen61">

            <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen62" style="height: auto;">

                <div id="quiz-item-1-ext-gen33" class=" x-panel quiz-item-container-panel x-panel-noborder" style="margin-right: 20px; width: auto;">

                    <div class="x-panel-bwrap" id="ext-gen90">

                        <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen91" style="width: auto; height: auto; visibility: visible;">

                            <div id="ext-comp-1023" class=" x-plain master-question-panel quiz-item-panel x-plain-noborder" style="width: auto;">
                                    
                                <h3 class="master-question-title x-plain-header-noborder x-unselectable" id="ext-gen92">
                                    <span class="question-number" id="ext-gen96"> </span>
                                    Питання1
                                </h3>

                                <div class="x-plain-bwrap" id="ext-gen93">

                                    <div class="x-plain-body x-plain-body-noborder" id="ext-gen94" style="width: auto; height: auto;">

                                        <div id="ext-comp-1024" class=" x-panel x-panel-noborder">

                                            <div class="x-panel-bwrap" id="ext-gen97">
                                                <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen98" style="height: auto;">
                                                </div>
                                            </div>

                                        </div>

                                        <div id="ext-comp-1025" class=" x-panel x-panel-noborder">
                                            <div class="x-panel-bwrap" id="ext-gen99">
                                                <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen100" style="height: auto;">
                                                </div>
                                            </div>
                                        </div>

                                        <div id="ext-comp-1026" class=" x-panel x-panel-noborder">

                                            <div class="x-panel-bwrap" id="ext-gen101">

                                                <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen102" style="height: auto;">

                                                    <div id="ext-comp-1027" class=" x-panel x-panel-noborder" style="width: auto;">

                                                        <div class="x-panel-bwrap"  id="ext-gen103">

                                                            <div class="x-panel-body x-panel-body-noheader x-panel-body-noborder" id="ext-gen104" style="width: auto; height: auto;">

                                                                <div class="x-form-item  x-hide-label" tabindex="-1">

                                                                    <label for="ext-comp-1057" style="width:100px;"class="x-form-item-label"></label>

                                                                    <div class="x-form-element" id="x-form-el-ext-comp-1057" style="padding-left:105px">

                                                                        <div class="x-form-check-wrap" id="ext-gen105" style="height: auto;">

                                                                            <input type="radio" autocomplete="off" id="ext-comp-1057" name="question_answer_1" class=" x-form-radio x-form-field" value="1">                                                             
                                                                            <label  for="ext-comp-1057" class="x-form-cb-label" id="ext-gen106">Відповіть1</label>

                                                                        </div>

                                                                    </div>

                                                                    <div class="x-form-clear-left"></div>

                                                                </div>

                                                                <div class="x-form-item  x-hide-label" tabindex="-1">

                                                                    <label for="ext-comp-1058" style="width:100px;" class="x-form-item-label"></label>

                                                                    <div class="x-form-element" id="x-form-el-ext-comp-1058" style="padding-left:105px">

                                                                        <div class="x-form-check-wrap" id="ext-gen107" style="height: auto;">
                                                                            
                                                                            <input type="radio" autocomplete="off"  id="ext-comp-1058" name="question_answer_1" class=" x-form-radio x-form-field" value="2">
                                                                            <label  for="ext-comp-1058" class="x-form-cb-label" id="ext-gen108">Відповіть2</label>

                                                                        </div>

                                                                    </div>

                                                                    <div class="x-form-clear-left"> </div>

                                                                </div>

                                                                <div class="x-form-item  x-hide-label" tabindex="-1">

                                                                    <label for="ext-comp-1059" style="width:100px;" class="x-form-item-label"></label>

                                                                    <div class="x-form-element"  id="x-form-el-ext-comp-1059"  style="padding-left:105px">

                                                                        <div class="x-form-check-wrap" id="ext-gen109"  style="height: auto;">

                                                                                <input type="radio" autocomplete="off" id="ext-comp-1059" name="question_answer_1" class=" x-form-radio x-form-field" value="3">
                                                                                <label for="ext-comp-1059" class="x-form-cb-label" id="ext-gen110">Відповіть3</label>
                                                                                
                                                                        </div>

                                                                    </div> 

                                                                    <div class="x-form-clear-left"></div>

                                                                </div>

                                                                <div class="x-form-item  x-hide-label"  tabindex="-1">

                                                                    <label for="ext-comp-1060"  style="width:100px;" class="x-form-item-label"></label>

                                                                    <div class="x-form-element" id="x-form-el-ext-comp-1060" style="padding-left:105px">
                                                                        <div class="x-form-check-wrap" id="ext-gen111" style="height: auto;">
                                                                            
                                                                            <input type="radio" autocomplete="off" id="ext-comp-1060" name="question_answer_1" class=" x-form-radio x-form-field" value="4">
                                                                            <label for="ext-comp-1060" class="x-form-cb-label" id="ext-gen112">Відповіть4</label>

                                                                        </div>
                                                                    </div> 

                                                                    <div class="x-form-clear-left"></div>

                                                                </div> 

                                                                <div class="x-form-item  x-hide-label" tabindex="-1">

                                                                    <label for="ext-comp-1061" style="width:100px;"  class="x-form-item-label"></label>

                                                                    <div class="x-form-element" id="x-form-el-ext-comp-1061" style="padding-left:105px">

                                                                        <div class="x-form-check-wrap" id="ext-gen113" style="height: auto;">
                                                                        
                                                                            <input type="radio" autocomplete="off" id="ext-comp-1061" name="question_answer_1" class=" x-form-radio x-form-field" value="5">
                                                                            <label for="ext-comp-1061" class="x-form-cb-label" id="ext-gen114">Відповіть5</label>

                                                                        </div>

                                                                    </div>

                                                                    <div class="x-form-clear-left"></div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- - -->
    <!-- - -->
    <!-- - -->
    <!-- end -->


</body>
</html>
