var currentHostname = window.location.hostname;
var api;

if (currentHostname == 'organization.tamkeen-selfassessment.localhost') {
    api = 'http://endpoints.tamkeen-selfassessment.localhost';
}
// else if(currentHostname  === 'organization.selfassest.localhost' ){
//       api = 'http://api.selfassest.localhost/';
// }
else {
    api = 'http://api.tamkeentechlab.com';
}

var app = new Vue({
    el: "#assessmentReport",
    vuetify: new Vuetify(),
    template: `
        <div class="" width='100%' >
          <div class="text-center survey-preloader" style="display:none">
              <v-progress-circular
              indeterminate
              color="primary"
              :size="50"
            ></v-progress-circular>
          </div>
                <div class="row sectiontitle report-title" data-html2canvas-ignore="true">
                    <v-col cols="6">
                      <h2 class='mt-0'>{{langAR.report}}</h2>
                    </v-col>

                    
                    
                    <v-col cols="6" class='actionBtns'>
                        <!-- <a class="btn primBtn" @click='savePDF'><i class="fas ml-2 mr-2 fa-file-pdf"></i> استخراج تقرير بإجاباتك</a> -->
                        <a class="btn secBtn" :href='"/assessment/default/view?id=" + SurveyId'></i> {{langAR.backToSurvey}}</a>
                    </v-col>
                </div>

                <div id="my-report" class="mt-5" >
                    
                <!-- <v-item-group>
                        <v-container>
                            <v-row>
                                <v-col
                                cols="12"
                                
                                >
                                <v-item>
                                    <v-card
                                    class="d-flex align-center"
                                    height="auto"
                                    outlined
                                    >
                                        <div class="d-flex flex-no-wrap justify-space-between align-center col-12">

                                            <div>
                                                <p class="d-block mb-1 brandPrimColor ">{{langAR.orgName}}: <span class="brandPTextColor">{{theme.organization.name}}</span></p>
                                                <p class="d-block mb-1 brandPrimColor">{{langAR.orgAddress}}: <span class="brandPTextColor">{{theme.organization.address}}</span></p>
                                                <p class="d-block mb-1 brandPrimColor">{{langAR.orgAbout}}: <span class="brandPTextColor">{{theme.organization.about}}</span></p>
                                            </div>
                                            <v-avatar
                                                class="ma-3"
                                                size="125"
                                                tile
                                            >
                                                <v-img contain :src="theme.organization.logo" :alt='theme.organization.name' :title='theme.organization.name'></v-img>
                                            </v-avatar>
                                            
                                        </div>
                                    
                                    </v-card>
                                </v-item>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-item-group> -->

                    <div class="sectiontitle report-details">
                        <h3 class="display-1 brandPrimColor flex-grow-1 text-center">{{assessmentTitle}} ({{reportGeneralInfo.survey_number}})</h3>
                        <p class='brandHTextColor'>{{assessmentDesc}}</p>
                       <!-- <v-row justify="center">
                            <v-col cols="12" sm="6" md="4" lg="3" class="">
                            تاريخ إنشاء الإستبيان: <span class="brandPTextColor">{{reportGeneralInfo.survey_created_at}}</span>
                            </v-col>
                            <v-col cols="12" sm="6" md="4" lg="3" class="">
                            ينتهي في: <span class="brandPTextColor">{{reportGeneralInfo.survey_expired_at}}</span>
                            </v-col>
                            <v-col cols="12" sm="6" md="4" lg="3" class="">
                            تاريخ ملىء الإستبيان: <span class="brandPTextColor">{{reportGeneralInfo.survey_end_at}}</span>
                            </v-col>
                              <v-col cols="12" sm="6" md="4" lg="3" class="">
                              الوقت المحدد: <span class="brandPTextColor">{{reportGeneralInfo.survey_time_to_pass}} دقيقة</span>
                            </v-col>
                        </v-row> -->
                        <!-- <v-row>
                            <v-col cols="12" sm="6" md="4" lg="3" class="">
                            عدد الأسئلة: <span class="brandPTextColor">{{reportGeneralInfo.survey_question_number}}</span>
                            </v-col>
                            <v-col cols="12" sm="6" md="4" lg="3" class="">
                            نسبة التقدم: <span class="brandPTextColor">{{Math.ceil(this.reportGeneralInfo.progress)}}%</span>
                            </v-col>
                            
                        </v-row> -->
                    </div>


                    


                    <div id="projectFacts" class="sectionClass">
                        <div class="fullWidth eight columns">
                            <div class="projectFactsWrap " style="justify-content: center;">
                                <div class="item wow fadeInUpBig animated animated" data-number="12" style="visibility: visible;">
                                    <i class="fas fa-tasks"></i>
                                    <p>{{langAR.correctAction}}</p>
                                    <p id="number1" class="number">{{reportGeneralInfo.survey_corrective_number}}</p>
                                    <span></span>
                                    <p v-if='reportGeneralInfo.survey_corrective_number'>{{langAR.mustFinished}}</p>
                                    <p v-else>{{langAR.doesntExist}}</p>
                                </div>

                                <div class="item wow fadeInUpBig animated animated" data-number="246" style="visibility: visible;">
                                    <i class="fas fa-calendar-day"></i>
                                    <p>{{langAR.assesFillDate}}</p>
                                    <p id="number4" class="number" v-if="reportGeneralInfo.survey_end_at">{{reportGeneralInfo.survey_end_at}}</p>
                                    <span v-if="reportGeneralInfo.survey_expired_at"></span>
                                    <p v-if="reportGeneralInfo.survey_expired_at">
                                    {{langAR.expiryDate}} : {{reportGeneralInfo.survey_expired_at}}
                                    </p>
                                </div>
                                
                                <div class="item wow fadeInUpBig animated animated" v-if="reportGeneralInfo.total_points" data-number="359" style="visibility: visible;">
                                    <i v-if="reportGeneralInfo.gained_points > (reportGeneralInfo.total_points/2) " class="far fa-smile"></i>
                                    <i v-else class="far fa-frown"></i>
                                    <p>{{langAR.mypoints}}</p>
                                    
                                    <p id="number3" class="number"  v-if="reportGeneralInfo.gained_points >= 0">{{reportGeneralInfo.gained_points ? reportGeneralInfo.gained_points : '0'}}/{{reportGeneralInfo.total_points}} </p>
                                    <p id="number3" class="number" v-else>{{langAR.withoutPoints}}</p>
                                    <span></span>
                                    <p>
                                    {{langAR.degree}} : {{reportGeneralInfo.gained_score}} 
                                    </p>
                                </div>

                                <div class="item wow fadeInUpBig animated animated" data-number="246" style="visibility: visible;">
                                    <i class="fas fa-clock"></i>
                                    <p>{{langAR.answerTime}}</p>
                                    <p id="number4" class="number">{{reportGeneralInfo.actual_time}} {{langAR.min}}</p>
                                    <span></span>
                                    <p>
                                    {{langAR.assesTimeToFinish}}: {{reportGeneralInfo.survey_time_to_pass}} {{langAR.min}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <v-card class="mb-5">
                        <v-card-title class="mb-5 search-card">
                        {{langAR.questions}} 
                            <v-spacer></v-spacer>
                            <v-text-field
                            v-model="search"
                            append-icon="mdi-search"
                            :label="langAR.search"
                            single-line
                            hide-details
                            :rows-per-page-items="[100, 150, 200, 250, 300]"
                            :pagination.sync="pagination"
                            ></v-text-field>
                        </v-card-title>
                        
                        <v-data-table class="mb-5 mt-5"
                            :headers="headers"
                            :items="questionsReport"
                            :search="search"
                            :custom-filter="customFilter"
                            hide-default-footer
                            :items-per-page="10000">
                                <template v-slot:item.qNum="{ item }" >
                                    <v-chip label color="#eee" >{{ item.qNum }}</v-chip>
                                </template>
                                <template v-slot:item.qGainedPoints="{ item }" >
                                    <v-chip v-if="item.qTotalPoints" :color="getLevel(item.qGainedPoints, item.qTotalPoints)" dark>{{ item.qTotalPoints }} / {{ item.qGainedPoints }}</v-chip>
                                </template>
                                <template v-slot:item.qAttatchments="{ item }">
                                    <div v-if="Array.isArray(item.qAttatchments)">
                                        <ul v-for="file in item.qAttatchments" :key="file.name">
                                            <li v-if="file.content" >
                                                <a :href="file.content" target="_blank">{{ file.name }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </template>
                                <template v-slot:item.qText="{ item }" >
                                    {{ item.qText }}
                                    <i class="fas ml-1 mr-1 fa-check-circle " style='color:green' v-if='getLevel(item.qGainedPoints, item.qTotalPoints) == "green" || item.qTotalPoints == null || item.qTotalPoints == 0'></i>
                                    <i class="fas ml-1 mr-1 fa-exclamation-triangle " style='color:orange' v-else-if='getLevel(item.qGainedPoints, item.qTotalPoints) == "orange"'></i>
                                    <i class="fas ml-1 mr-1 fa-exclamation-circle" style='color:#cebe32' v-else-if='getLevel(item.qGainedPoints, item.qTotalPoints) == "#cebe32"'></i>

                                    <i class="fas ml-1 mr-1 fa-times-circle" style='color:red' v-else></i>
                                </template>

                                <template v-slot:item.qAnswer="{ item }">

                                    <div v-if="Array.isArray(item.qAnswer) && item.qType == 'File'">
                                        <ul>
                                            <li v-for="file in item.qAnswer" :key="file.id">
                                                <a :href="file.content" target="_blank">
                                                {{file.name}}
                                                </a>
                                            </li>
                                        </ul>
                                        
                                    </div>
                                    <ul v-else-if="Array.isArray(item.qAnswer) && item.qType == 'Multiple choice'">
                                        <li v-for="choice in item.qAnswer" :key="choice.value">
                                            {{choice.value}}
                                            <i class="fas ml-1 mr-1 fa-check " style='color:green' v-if='choice.correct'></i>
                                            <i class="fas ml-1 mr-1 fa-times " style='color:red' v-else></i>
                                        </li>
                                    </ul>
                                    <ul v-else-if="item.qType == 'Dropdown' || item.qType == 'One choise of list'">
                                        <li>
                                            {{item.qAnswer.value}}
                                            <i class="fas ml-1 mr-1 fa-check " style='color:green' v-if='item.qAnswer.correct'></i>
                                            <i class="fas ml-1 mr-1 fa-times " style='color:red' v-else></i>
                                        </li>
                                    </ul>
                                    <ul v-else-if="Array.isArray(item.qAnswer) && item.qType == 'Ranking'">
                                        <li v-for="choice in item.qAnswer" :key="choice" v-html="choice">
                                            
                                        </li>
                                    </ul>
                                    <div v-else>
                                        {{item.qAnswer}}
                                        {{item.qNotApplicable}}

                                    </div>
                                </template>
                                <template v-slot:item.qCorrectiveActions="{ item }">
                                    <ul v-if="Array.isArray(item.qCorrectiveActions)" style=" border-radius:10px;  color:black;">
                                        <li v-for="(action, index) in item.qCorrectiveActions" class="mt-3 mb-3 mr-3 ml-3" :key='action + index' v-html="action"></li>
                                    </ul>
                                    <p v-else class="mt-3 mb-3 mr-3 ml-3" style=" border-radius:10px; color:black;" v-html="item.qCorrectiveActions"></p>
                                </template>
                                <v-alert slot="no-results" :value="true" color="error" icon="mdi-warning">
                                {{langAR.noResults}}   {{search}}
                                </v-alert>
                        </v-data-table>
                    </v-card>
                    <v-card class="mt-4 mb-5" v-if="reportGeneralInfo.survey_corrective_number>0" >
                        <v-card-title class="mb-5 search-card">{{langAR.correctAction}}</v-card-title>
                        <template>
                            <v-simple-table class="tablepop">
                                <template v-slot:default>
                                    <thead>
                                        <tr>
                                            <th>{{langAR.question}}</th>
                                            <th>{{langAR.correctAction}}</th>
                                            <th>{{langAR.dateToFinish}}</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <tr  v-for="(item,i) in reportGeneralInfo.survey_corrective_actions"
                                    :key="i">
                                        <td>{{ item.question }}</td>
                                        <td v-html="item.corrective_action"></td>
                                        <td v-html="item.corrective_action_date"></td>
                                    </tr>
                                </tbody>
                                </template>
                            </v-simple-table>
                        </template>                                    
                    </v-card>
                </div>

      
                <div id="noreport" style="display:none">
                    <p>  {{langAR.noAccessToReport}} </p><div class="emptyassessment"><div class="img"></div><div class="name"></div></div><div class="emptyassessment"><div class="img"></div><div class="name"></div></div>
        
                    <div class="col-md-12 text-center">
                            <a class="btn btn-primary" href="/assessment/default/view?id=<?= $survey->survey_id ?>">{{langAR.backToSurvey}}</a>        
                        </div>
                </div>
        </div>
          


    `,

    data: {
        Api: api,
        tocken: $("#assessmentReport").attr("data-tocken"),
        SurveyId: $("#assessmentReport").attr("data-SurveyId"),
        UserId: $("#assessmentReport").attr("data-UserId"),
        Asses: {},
        search: '',
        headers: [
            { text: 'الرقم', align: '', sortable: true, value: 'qNum' },
            { text: 'السؤال', align: '', value: 'qText' },
            { text: 'الإجابة', align: '', value: 'qAnswer' },
            { text: 'الملفات المرفقة', align: '', value: 'qAttatchments' },
            { text: 'النقاط المحصلة', align: '', value: 'qGainedPoints' },
            // { text: 'النقاط الإجمالية', align: '', value: 'qTotalPoints' },
            { text: 'ملاحظات', align:'', value: 'qCorrectiveActions' },
        ],
        assessmentData: {},
        dialog: false,
        surveyResults: {},
        answerValue: true,
        questionsReport: [],
        reportGeneralInfo: {},
        assessmentTitle: '',
        assessmentDesc: '',
        pagination: {
            rowsPerPage: 100
        },
        methods: {
            customFilter(items, search, filter) {
                search = search.toString().toLowerCase();
                return items.filter(row => filter(row["qNum"], search));
            }
        },

        langAR: {
            min: 'دقيقة',
            search: 'بحث',
            doesntExist: 'لا توجد',
            backToSurvey: 'العودة للإستبيان',
            noAccessToReport: 'لا تملك الصلاحية للدخول إلي التقرير',
            mustFinished: 'يجب الإنتهاء منها',
            notes: 'ملاحظات',
            page: 'صفحة',
            choosePage: 'اختر الصفحة',
            dateToFinish:'تاريخ الإنتهاء',
            withoutPoints:'بدون نقاط',
            noResults: 'لا توجد نتائج',
            degree: 'الدرجة',
            answerTime: 'وقت الإجابة',
            timeNotSet: 'غير محدود بوقت',
            expDateNotSet: 'لم يحدد تاريخ الإنتهاء',
            closedForNow: 'هذا الإستبيان مغلق الآن',
            assesCreationDate: 'تاريخ إنشاء الإستبيان',
            assesFillDate: 'تاريخ ملىء الإستبيان',
            assesNumId: 'رقم الإستبيان',
            assesCorrectiveANum: 'الإجراءات التصحيحية',
            assesTimeToFinish: 'الوقت المحدد',
            noAssessments: 'ليس لديك أي استبيانات مسجلة',
            validTypes: "الملفات المرفقة لابد ان تكون بالامتدادات التالية (.pdf | .png | .jpeg | .jpg | .doc | .xls | .xlsx | .docx)",
            expiryDate: 'ينتهي في',
            qNum: 'عدد الأسئلة',
            attatchments: 'الملفات المرفقة',
            type: 'نوع السؤال',
            report: "التقرير",
            download: "استخراج تقرير بإجاباتك",
            progress: "نسبة التقدم",
            pointsCount: "مجموع النقاط",
            mypoints: "النقاط المحصلة",
            time: "وقت الإستبيان",
            search: "البحث",
            questions: 'الأسئلة',
            nosearch: 'لا توجد نتائج للبحث',
            pause: 'الحفظ والإستكمال في وقت لاحق',
            num: 'الرقم',
            question: 'السؤال',
            answer: 'الإجابة',
            correctAction: 'الإجراءات التصحيحية',
            remainTime: 'الوقت المتبقي',
        },
        langEN: {
            min: 'mins',
            search: 'search',
            doesntExist: 'Does not exist',
            backToSurvey: 'Back To Assessment',
            noAccessToReport: 'Access to this report is denied!',
            mustFinished: 'Must be finished',
            notes: 'Notes',
            page: 'page',
            choosePage: 'Choose Page',
            dateToFinish:'Date to finish',
            withoutPoints:'without points',
            noResults: 'No Results',
            degree: 'Degree',
            answerTime: 'Answer Time',
            timeNotSet: 'Time Not Set',
            expDateNotSet: 'Expiry Date Not set',
            closedForNow: 'Closed For Now',
            assesCreationDate: 'Created At',
            assesFillDate: 'Filled At',
            assesNumId: 'Assessment ID',
            assesCorrectiveANum: 'Corrective Actions Number',
            assesTimeToFinish: 'Time To Finish',
            noAssessments: 'There is No Assessments Recorded for Now',
            validTypes: "Attatched Files Must be in these Formats (.pdf | .png | .jpeg | .jpg | .doc | .xls | .xlsx | .docx)",
            expiryDate: 'Ends At',
            qNum: 'Questions Numper',
            attatchments: 'Attatched Files',
            type: 'Type',
            report: "Report",
            download: "Export Report",
            progress: "My Progress",
            pointsCount: "Total Points",
            mypoints: "My Points",
            time: "Actual Time",
            search: 'Search',
            questions: 'Questions',
            nosearch: 'No search results to view',
            pause: 'Save and complete in another time',
            num: 'Number',
            question: 'Question',
            answer: 'Answer',
            correctAction: 'Corrective Actions',
            remainTime: 'Remaining Time',

        },
    },
    mounted() {
        $.ajax({
            url: api + "/assessments/custom-report/" + this.SurveyId + "/" + this.UserId,
            method: "GET",
            "headers": {
                "Content-Type": "application/json",
                Authorization: "Bearer " + this.tocken

            },
            beforeSend: function() {
                $(".survey-preloader").show()

            },
            success: res => {
                if (res.status == 200) {

                    this.questionsReport = res.data.answers
                    this.reportGeneralInfo = res.data.generalInfo
                    this.assessmentDesc = res.data.description
                    this.assessmentTitle = res.data.title
                    $("#tabletemplate").show()
                    $("#projectFacts").show()
                    $(".content-header").show()
                    $(".survey-preloader").hide()
                }
            },
            error: res => {
                $("#tabletemplate").hide()
                $("#projectFacts").hide()
                $("#noreport").show()
                $(".survey-preloader").hide()

            }
        });

    },
    methods: {
        savePDF() {

            let myReport = document.getElementById('my-report'),
                options = {
                    logging: true,
                    // taintTest: false,
                    allowTaint: true,
                }



            html2canvas(myReport, options).then(function(canvas) {
                var hide = document.createElement('style')
                hide.innerHTML = ''
                document.head.appendChild(hide)
                print();
                hide.remove();
            });

        },

        getLevel(gained, total) {
            if ((gained / total) * 100 < 25 || total == 0) {
                return 'red'
            } else if ((gained / total) * 100 >= 25 && (gained / total) * 100 < 50) {
                return 'orange'
            } else if ((gained / total) * 100 >= 50 && (gained / total) * 100 < 75) {
                return '#cebe32'
            } else {
                return 'green'
            }
        },


    },

    computed: {


    }
});