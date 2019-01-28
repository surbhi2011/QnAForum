<?php

namespace App;

use http\Client\Response;
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
            return $question;
        }
        return "Unauthorized";
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
            Question::find($id)->votes()->delete();
            Question::find($id)->delete();
            //$question = Question::where('id',$id)->get();

        }
    }
    public function gall($type)
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
        }
        return $question->makeHidden('category');
    }
    public function getQuestion($id)
    {
        $question = Question::find($id);
        return $question;
    }
    public function getAllUserQuestions($id)
    {
        $question = User::find($id)->questions()->get();
        return $question;
    }
    public function getAllCategoryQuestions($category)
    {
        $question = Category::where('name',$category)->first()->questions()->get();
        foreach ($question as $que)
        {
            $que->Total_Answers = $que->answers()->count();
            $que->upvote = $que->votes()->where('type','1')->count();
            $que->downvote = $que->votes()->where('type','0')->count();
        }
        return $question;
    }

    public function getList($id)
    {
        $que = $this->getQuestion($id);
        $answers = $que->answers()->get();
        $acollect = [];
        $cnt = $answers->count();
        foreach ($answers as $ds)
        {
            $acollect[$ds->id] = Answer::getAnswer($ds->id);
        }

        $q = new Question();
        $qup = $que->votes()->where('type','1')->count();
        $qdown = $que->votes()->where('type','0')->count();
        $name = User::find($que->user_id)->name;
        $data = [
            'id' => $id,
            'title' => $que->title,
            'description' => $que->description,
            'Asked By' => $name,
            'Total Answers' => $cnt,
            'Answer' => $acollect,
            'Question upvotes' => $qup,
            'Question downvotes' => $qdown
        ];
        return $data;
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
            return ($this->gall("asc")->count());
        }
        //return json_encode("You can not see no of questions.");
//        $response  = [
//            "message" => "You can not see no of questions.",
//            "data" =>
//        ];

        //return \response()->json($response);
        return false;
    }

}
