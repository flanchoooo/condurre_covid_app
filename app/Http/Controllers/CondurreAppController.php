<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CondurreAppController extends Controller
{
    public function homePage()
    {
        return view('home.home');
    }

    public function displayCompanies()
    {
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/companies?page=0&size=1000000', [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'size' => 10000
                ]
            ]);
            $rec = $result->getBody()->getContents();
            $response = json_decode($rec);
            return view('company.display')->with('records', $response->pageable->content);
        } catch (\Exception $e) {
            session()->flash('registration_notification', $e->getMessage());
            return redirect()->back();
        }
    }

    public function createCompany()
    {
        return view('company.create');
    }

    public function createsCompany(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL') . '/companies', [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'name' => $request->name,
                    'longitute' => 0,
                    'latitude' => 0,
                ]
            ]);
            $rec = $result->getBody()->getContents();
            return redirect('/company/display');
        } catch (\Exception $e) {
            session()->flash('registration_notification', $e->getMessage());
            return redirect()->back();
        }
    }

    public function companyById(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/companies/' . $request->id, [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
            ]);
            $rec = $result->getBody()->getContents();
            $response = json_decode($rec);
            session()->flash('id', $response->model->id);
            session()->flash('name', $response->model->name);
            return view('company.update');
        } catch (\Exception $e) {
            session()->flash('registration_notification', $e->getMessage());
            return redirect()->back();
        }
    }

    public function updatesCompany(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->put(env('BASE_URL') . '/companies', [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'name' => $request->name,
                    'longitute' => 0,
                    'latitute' => 0,
                    'id' => $request->id,
                ]
            ]);
            $rec = $result->getBody()->getContents();
            return redirect('/company/display');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function displayExams()
    {
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/exams?page=0&size=1000000', [
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'size' => 10000
                ]
            ]);
            $rec = $result->getBody()->getContents();
            $response = json_decode($rec);
            return view('exam.display')->with('records', $response->pageable->content);
        } catch (\Exception $e) {
            if($e->getCode() == 400){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return redirect('/company/exams');
            }
            session()->flash('error', $e->getMessage());
            return redirect('/company/exams');
        }
    }

    public function createExam()
    {
        return view('exam.create');
    }

    public function createsExam(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL') . '/exams', [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'exam_title' => $request->name,
                    'duration' => 30,
                    'company_admin_id' => 21,
                ]
            ]);
            $rec = $result->getBody()->getContents();
            return redirect('/company/exams');
        } catch (\Exception $e) {
            if($e->getCode() == 400){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return redirect('/company/exams');
            }
            session()->flash('error', $e->getMessage());
            return redirect('/company/exams');
        }
    }

    public function examById(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/exams/' . $request->id, [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
            ]);
            $rec = $result->getBody()->getContents();
            $response = json_decode($rec);
            session()->flash('id', $response->model->id);
            session()->flash('name', $response->model->exam_title);
            return view('exam.update');
        } catch (\Exception $e) {
            if($e->getCode() == 400){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return redirect('/company/exams');
            }
            session()->flash('error', $e->getMessage());
            return redirect('/company/exams');
        }
    }

    public function updatesExam(Request $request)
    {
        // return $request->all();
        try {
            $client = new Client();
            $result = $client->put(env('BASE_URL') . '/exams', [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'exam_title' => $request->name,
                    'duration' => 30,
                    'company_admin_id' => 21,
                    'id' => $request->id,
                ]
            ]);
             $rec = $result->getBody()->getContents();
            return redirect('/exam/display');
        } catch (\Exception $e) {
            if($e->getCode() == 400){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return redirect('/company/exams');
            }
            session()->flash('error', $e->getMessage());
            return redirect('/company/exams');
        }
    }

    public function examQuestions(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/exams/' . $request->id, [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
            ]);
            $rec = $result->getBody()->getContents();
            session()->flash('exam_id',$request->id);
            $response = json_decode($rec)->model->questions;
            return view('exam.questions')->with(['records' => $response]);
        } catch (\Exception $e) {
            if($e->getCode() == 400){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return redirect('/company/exams');
            }
            session()->flash('error', $e->getMessage());
            return redirect('/company/exams');
        }
    }

    public function possibleAnswers(Request $request)
    {

        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/questions/' . $request->id, [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
            ]);
            $rec = $result->getBody()->getContents();
            $response = json_decode($rec);
            $res = $response->model->question_choices;
            session()->flash('question_text', $request->question_text);
            session()->flash('questions_id', $request->id);
            return view('exam.answers')->with(['records' => $res]);
        } catch (\Exception $e) {
            if($e->getCode() == 400){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return redirect('/company/exams');
            }
            session()->flash('error', $e->getMessage());
            return redirect('/company/exams');
        }
    }


    ///// COMPANY ADMINS
    public function displayCompaniesAdmin()
    {
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/companies?page=0&size=1000000', [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'size' => 10000
                ]
            ]);
            $rec = $result->getBody()->getContents();
            $response = json_decode($rec);
            return view('company-admin.display')->with('records', $response->pageable->content);
        } catch (\Exception $e) {
            session()->flash('registration_notification', $e->getMessage());
            return redirect()->back();
        }
    }

    public function companyAdminsById(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/companies/' . $request->id, [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
            ]);
            $rec = $result->getBody()->getContents();
            $response = json_decode($rec);
            session()->flash('id', $response->model->id);
            session()->flash('name', $response->model->name);
            return view('company-admin.create')->with(['company' => $response->model]);
        } catch (\Exception $e) {
            session()->flash('registration_notification', $e->getMessage());
            return redirect()->back();
        }
    }

    public function createCompanyAdmin(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL') . '/company-admins', [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'company_id' => $request->input('company_id'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'middle_names' => $request->input('middle_names'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                ]
            ]);
            $rec = $result->getBody()->getContents();
            return redirect('/company-admin/display');
        } catch (\Exception $e) {
            session()->flash('registration_notification', $e->getMessage());
            return redirect('/company-admin/display');
            //return redirect()->back();
        }
    }

    public function companyAdminsViewByCompanyId(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/company-admins?page=0&size=1000000', [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'size' => 10000
                ]
            ]);
            $rec = $result->getBody()->getContents();
            $response = json_decode($rec);


            return view('company-admin.display-admin')->with('records', $response->pageable->content);
        } catch (\Exception $e) {
            session()->flash('registration_notification', $e->getMessage());
            return redirect()->back();
        }
    }

    public function updateCompanyAdmins(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/company-admins/' . $request->input('id'), [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
            ]);
            $rec = $result->getBody()->getContents();
            $response = json_decode($rec);
            return view('company-admin.update')->with(['companyAdmin' => $response->model]);
        } catch (\Exception $e) {
            session()->flash('registration_notification', $e->getMessage());
            return redirect()->back();
        }
    }

    public function updateCompanyAdminsPost(Request $request)
    {
        // return $request->all();
        try {
            $client = new Client();
            $result = $client->put(env('BASE_URL') . '/company-admins', [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'id' => $request->input('id'),
                    'first_name' => $request->input('first_name'),
                    'middle_names' => $request->input('middle_names'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password')
                ]
            ]);
             $rec = $result->getBody()->getContents();
            return redirect('/exam/display');
        } catch (\Exception $e) {
            return $e;
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }


    ///// VISITORS
    public function displayVisitors()
    {
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/visitors?page=0&size=1000000', [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'size' => 10000
                ]
            ]);
            $rec = $result->getBody()->getContents();
            $response = json_decode($rec);
            return view('visitors.display')->with('records', $response->pageable->content);
        } catch (\Exception $e) {
            session()->flash('registration_notification', $e->getMessage());
            return redirect()->back();
        }
    }

    public function displayVisitorById(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->get(env('BASE_URL') . '/visitors/' . $request->input('id'), [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'size' => 10000
                ]
            ]);
            $rec = $result->getBody()->getContents();
            $response = json_decode($rec);
            return view('visitors.update')->with('record', $response->model);
        } catch (\Exception $e) {
            session()->flash('registration_notification', $e->getMessage());
            return redirect()->back();
        }
    }

    public function updateVisitor(Request $request){
        try {
            $client = new Client();
            $result = $client->put(env('BASE_URL') . '/visitors', [
                //'auth' => [ env('AUTH_USER_NAME'),env('AUTH_PASSWORD')],
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'id' => $request->input('id'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'middle_names' => $request->input('middle_names'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                ]
            ]);
            $rec = $result->getBody()->getContents();
            return redirect('/visitors/display');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function createQuestion(Request $request){
        session()->flash('id',$request->id);
        return view('exam.create_question');

    }

    ////////QUESTIONS

    public function createsQuestions(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL') . '/questions', [
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'question_text' => $request->question_text,
                    'active' => $request->active,
                    'exam_id' => $request->exam_id,
                    'difficult_level' => $request->difficult_level,
                ]
            ]);
            $rec = $result->getBody()->getContents();
            return redirect('/company/exams');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function updateQuestions(Request $request){
        session()->flash('id',$request->id);
        session()->flash('question_text',$request->question_text);
        session()->flash('exam_id',  session('exam_id'));
        return view('exam.update_question');

    }

    public function updatesQuestions(Request $request)
    {

        try {
            $client = new Client();
            $result = $client->put(env('BASE_URL') . '/questions', [
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'id' => $request->question_id,
                    'exam_id' => $request->question_id,
                    'question_text' => $request->question_text,
                    'difficult_level' => $request->difficult_level,
                    'active' => $request->active,
                    'duration' => 30,
                    'company_admin_id' => 21,

                ]
            ]);
            $rec = $result->getBody()->getContents();
            return redirect('/company/exams');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }


    //////////Answers
    public function createAnswers(Request $request){
        session()->flash('id',$request->id);
        session()->flash('question_text',$request->question_text);
       return view('exam.create_answer');

   }

    public function createsAnswers(Request $request)
    {
     //   return $request->all();
        try {
            $client = new Client();
            $result = $client->post(env('BASE_URL') . '/question-choices', [
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'question_choice_text'  => $request->question_choice_text,
                    'question_id'           => $request->question_id,
                    'correct'               => $request->correct,
                ]
            ]);
            $rec = $result->getBody()->getContents();
            return redirect('/company/exams');
        } catch (\Exception $e) {
            if($e->getCode() == 400){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return redirect('/company/exams');
            }
            session()->flash('error', $e->getMessage());
            return redirect('/company/exams');
        }
    }

    public function updatesAnswers(Request $request){
        session()->flash('id',$request->id);
        session()->flash('question_choice_text',$request->question_choice_text);
        session()->flash('question_text',session('question_text'));
        session()->flash('questions_id',  session('questions_id'));
        return view('exam.update_answer');

    }
    public function updateAnswer(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->put(env('BASE_URL') . '/question-choices', [
                'headers' => ['Content-type' => 'application/json'],
                'json' => [
                    'question_choice_text' => $request->question_choice_text,
                    'id' => $request->id,
                    'question_id' => $request->questions_id,
                    'correct' => $request->correct,
                ]
            ]);

            $rec = $result->getBody()->getContents();
            return redirect('/company/exams');
        } catch (\Exception $e) {
            if($e->getCode() == 400){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return redirect('/company/exams');
            }
            session()->flash('error', $e->getMessage());
            return redirect('/company/exams');
        }
    }

    public function examDelete(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->delete(env('BASE_URL') . '/exams/'. $request->id, [
                'headers' => ['Content-type' => 'application/json'],
            ]);

            $rec = $result->getBody()->getContents();
            return redirect('/company/exams');
        } catch (\Exception $e) {
            if($e->getCode() == 400){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return redirect('/company/exams');
            }
            session()->flash('error', $e->getMessage());
            return redirect('/company/exams');
        }
    }

    public function questionsDelete(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->delete(env('BASE_URL') . '/questions/'. $request->id, [
                'headers' => ['Content-type' => 'application/json'],
            ]);

            $rec = $result->getBody()->getContents();
            return redirect('/company/exams');
        } catch (\Exception $e) {
            if($e->getCode() == 400){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return redirect('/company/exams');
            }
            session()->flash('error', $e->getMessage());
            return redirect('/company/exams');
        }
    }

    public function answersDelete(Request $request)
    {
        try {
            $client = new Client();
            $result = $client->delete(env('BASE_URL') . '/question-choices/'. $request->id, [
                'headers' => ['Content-type' => 'application/json'],
            ]);

            $rec = $result->getBody()->getContents();
            return redirect('/company/exams');
        } catch (\Exception $e) {
            if($e->getCode() == 400){
                $exception = $e->getResponse()->getBody();
                $response = json_decode($exception)->description;
                session()->flash('error', $response);
                return redirect('/company/exams');
            }
            session()->flash('error', $e->getMessage());
            return redirect('/company/exams');
        }
    }


}
