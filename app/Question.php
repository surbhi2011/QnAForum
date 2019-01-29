<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Answer;

class Question extends Model
{
    private $user;
    protected $fillable=[
      'title','description','user_id','category_id'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->user = Auth::user();
    }

    public function answers()
    {
        return $this->hasMany('App\Answer','question_id','id');
    }
    public function votes()
    {
        return $this->morphMany('App\Vote','voteable');
    }

    public function add(array $attributes, $id)
    {
//      dd($attributes['title']);
        $user = Auth::user();
        $uid = $user->id;
        $question = Question::create([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'user_id' => $uid,
            'category_id' => $id
        ]);
        return $question;
    }
    public function up(array $attributes, $id)
    {
        $que = Question::findOrFail($id);
        if ($this->user->can('update', $que))
        {
            $question = Question::findOrFail($id);
            $question->update($attributes);
            $question->category_name = $que->category->name;
            $question->upvote = $que->votes()->where('type','1')->count();
            $question->downvote = $que->votes()->where('type','0')->count();
            return $question;
        }
        $response= [
            "message"=>"Unauthorized"
        ];
        return response()->json($response);
    }
    public function del($id)
    {
        $que = Question::findOrFail($id);
        if ($this->user->can('delete', $que)) {
            $ans = Question::find($id)->answers()->get();
            //dd($ans);
            foreach ($ans as $a) {
                $a->del($a->id);
            }
            // Question::find($id)->answers()->delete();
            //dd('test');
            Question::findorFail($id)->votes()->delete();
            Question::findorFail($id)->delete();
            //$question = Question::where('id',$id)->get();
        //dd('test');

            $response= [
                "message"=>"Question Deleted"
            ];
            return response()->json($response);
        }
        $response= [
            "message"=>"Unauthorized"
        ];
        return response()->json($response);
    }
    public function getAllQuestions($type)
    {
        if($type == "desc")
            $question = Question::latest()->get();
        else
            $question = Question::all();

        foreach ($question as $que)
        {
            $que->category_name = $que->category->name;
            $que->total_answers = $que->answers()->count();
            $que->upvote = $que->votes()->where('type','1')->count();
            $que->downvote = $que->votes()->where('type','0')->count();
            $que->questionAskedBy = $que->user->name;
        }
        return $question->makeHidden('category');
    }
    public function getQuestion($id)
    {
        $question = Question::findorFail($id);
        return $question;
    }
    public function getAllUserQuestions($id)
    {
        $question = User::findorFail($id)->questions()->get();
        foreach ($question as $que) {
            $que->category_name = $que->category->name;
            $que->upvote = $que->votes()->where('type','1')->count();
            $que->downvote = $que->votes()->where('type','0')->count();
            $que->questionAskedBy = User::findorFail($id)->name;
        }
        return $question->makeHidden('category');
    }
    public function getAllCategoryQuestions($category)
    {
        $cat = Category::where('name',$category)->first();
        if($cat!=null)
        {
            $question= $cat->questions()->get();
        }
        else
        {
            $question = Question::all();
        }
        foreach ($question as $que)
        {
            $que->category_name = $que->category->name;
            $que->Total_Answers = $que->answers()->count();
            $que->upvote = $que->votes()->where('type','1')->count();
            $que->downvote = $que->votes()->where('type','0')->count();
        }
        return $question->makeHidden('category');
    }

    public function getList($id)
    {
        $que = $this->getQuestion($id);
        $answers = $que->answers()->get();
//        dd($que);
//        dd($answers);
//        $acollect = $que::with(['answers.votes' => function($ans){
//            $ans->where('type','1')->count();
//            //$ans->votes()->where('type','0')->count();
//        }])->get();

//        $acollect = $que::with(['answers'])->get();
         $que->load('answers');

        foreach($que->answers as $q)
        {
            $q['upvotes']=$q->votes()->where('type','1')->count();
            $q['downvotes']=$q->votes()->where('type','0')->count();
            $q['answered by']=User::find($q->user_id)->name;
        }
//        foreach($acollect as $acol)
//        {
//            $acol->answers->aup= $acol->votes()->where('type','1')->count();
//            $acol->answers->adown = $acol->votes()->where('type','0')->count();
//        }

        $que['category']=Category::find($que->category_id)->name;
        $que['answers count'] = $answers->count();
        $que['question upvotes'] = $que->votes()->where('type','1')->count();
        $que['question down'] = $que->votes()->where('type','0')->count();
        $que['questioned by']= User::find($que->user_id)->name;
        /*$data = [
            'id' => $id,
            'title' => $que->title,
            'description' => $que->description,
            'Asked By' => $name,
            'Total Answers' => $cnt,
            'Answer' => $acollect->answers,
            'Question upvotes' => $qup,
            'Question downvotes' => $qdown
        ];*/
        return $que->makeHidden('user_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Category','category_id','id');
    }
    public function getAllQuestionCount()
    {
        if($this->user->can('view',Question::class)){
            $question= $this->getAllQuestions("asc")->count();
            $response = [
                "Total Questions" => $question
            ];
                return response()->json($response);
        }
        $response= [
          "message"=>"You can not see no of questions."
        ];
        return response()->json($response);
    }
}
