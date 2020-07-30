<template>
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">
                                    <h1 class="h4 text-gray-900 mb-4">Create Exam Questions</h1>
                                </div>
                                <div class="alert alert-success" v-if="success">
                                    Question Added!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="dismissAlert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="alert alert-error" v-if="error">Failed to add question</div>
                                <form @submit.prevent="submitQuestion">
                                    <div class="form-group">
                                        <label>Question</label>
                                        <input id="mobile" type="text" class="form-control" name="question_text"
                                               required autofocus v-model="question_text">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Difficulty Level</label>
                                                <select type="text" class="form-control" name="difficult_level" required
                                                        autofocus v-model="difficult_level">
                                                    <option value="EASY">EASY</option>
                                                    <option value="MEDIUM">MEDIUM</option>
                                                    <option value="DIFFICULT">DIFFICULT</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Question Status</label>
                                                <select type="text" class="form-control" name="active" required
                                                        autofocus v-model="active">
                                                    <option value="true">ACTIVE</option>
                                                    <option value="false">IN-ACTIVE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <h5 class="text-gray-900">
                                        Options
                                    </h5>
                                    <br>
                                    <div v-for="(question, index) in options">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                {{index + 1}}
                                            </div>
                                            <div class="col-sm-6">
                                                <input id="mobile" type="text" class="form-control" name="question_text"
                                                       required autofocus v-model="question.question_choice_text">
                                            </div>
                                            <div class="col-sm-3">
                                                <select type="text" class="form-control" name="active" required
                                                        autofocus v-model="question.correct">
                                                    <option value="true">Correct Answer</option>
                                                    <option value="false">Incorrect Answer</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-danger"
                                                        @click="removeOption(index)">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <a class="green-text clickable" @click="addOption">Add Option</a>
                                    <hr>

                                    <div class="row">
                                        <div class="col-12" v-if="!processing">
                                            <button class="btn btn-block btn-primary">Submit Question
                                            </button>
                                        </div>
                                        <div class="d-flex align-items-center text-center" v-if="processing">
                                            <strong class="omnes-bold blue-text">Saving Data...</strong>
                                            <div class="spinner-grow orange-text ml-auto" style="width: 3rem; height: 3rem;" role="status"
                                                 aria-hidden="true"></div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name   : "AddQuestionComponent",
        props  : {
            exam   : String,
            token  : String,
            baseUrl: String,
        },
        data   : function () {
            return {
                account_number : null,
                error_message  : null,
                searching      : false,
                options        : [{'question_choice_text': '', 'correct': true, 'question_id': ''}],
                currency       : {},
                account_type   : null,
                success_message: null,
                success        : false,
                loading        : false,
                question_text  : null,
                difficult_level: null,
                active         : null,
                processing     : false
            }
        },
        methods: {
            reset() {
                Object.assign(this.$data, this.$options.data());
            },
            addOption() {
                this.options.push({'question_choice_text': '', 'correct': true, 'question_id': ''})
            },
            removeOption(index) {
                this.options.splice(index, 1)
            },
            submitQuestion() {

                if (this.options.length === 0) {
                    alert('Please enter question options');
                    return;
                }
                this.processing = true;

                console.log(this.exam);

                axios.post('http://144.91.64.120:35610/api/questions', {
                    'exam_id'        : this.exam,
                    'active'         : this.active,
                    'question_text'  : this.question_text,
                    'difficult_level': this.difficult_level

                }, {
                    headers: {
                        'Content-Type' : 'application/json',
                        'Authorization': 'Bearer ' + this.token
                    }
                })
                    .then(response => {

                        if (response.data.code != '00') {
                            alert('Failed to save your question please try again later.');
                            this.processing = false;
                            return;
                        }

                        this.options.forEach(function (option) {
                            option.question_id = response.data.model.id;
                            axios.post('http://144.91.64.120:35610/api/question-choices', option, {
                                headers: {
                                    'Content-Type' : 'application/json',
                                    'Authorization': 'Bearer ' + this.token
                                }
                            }).then(response => {
                                console.log(response)
                            }).catch(error => {
                                console.log(error)
                            })


                        }.bind(this));
                        this.processing = false;


                        this.reset();
                        this.success = true;


                        console.log(response);
                    })
                    .catch(error => {
                        console.log(error)
                    })
                ;


                console.log('Bearer ' + this.token);

                console.log(this.options);
            },
            dismissAlert() {
                this.success = false
            }
        }
    }
</script>

<style scoped>

</style>
