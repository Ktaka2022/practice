<?php
​
namespace App\Models;
​
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
​
class product extends Model
{
    protected $table = "products";
​
    protected $fillable = [
        'id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
        'created_at',
        'updated_at'
    ];
​
    /**
    * 授業一覧用取得処理
    *
    */
    public function getCurriculumQuery($classes_id) {
        $query = DB::table($this->table)
        ->where('classes_id',$classes_id)
        // ->orderByRaw('CHAR_LENGTH(title) desc')
        ->orderBy('title','asc');
​
        return $query;
    }
​
    /**
    * 必須授業取得処理
    *
    */
    public function getRequireCurriculumQuery($classes_id) {
        $query = DB::table($this->table)
        ->where('classes_id',$classes_id)
        ->where('require_flg',1)
        ->orderBy('require_flg','desc')
        ->orderBy('display_number','asc');
​
        return $query;
    }
​
    /**
    * 削除時判定用
    *
    */
    public function getRequireCurriculum($classes_id,$id) {
        $data = DB::table($this->table)
        ->where('classes_id',$classes_id)
        ->where('require_flg',1)
        ->where('id','<>',$id)
        ->exists();
​
        return $data;
    }
​
    /**
    * 授業一詳細様取得処理
    *
    */
    public function getCurriculumDetailQuery($id) {
        $query = DB::table($this->table)
        ->where('id',$id);
​
        return $query;
    }
​
    /**
    * 授業display_number取得処理
    *
    */
    public function getDisplayNumber($id) {
        $query = DB::table($this->table)
        ->where('classes_id',$id)->max('display_number');
​
        return $query;
    }
​
    /**
    * 授業id取得処理
    *
    */
    public function getCurriculumId($classes_id,$display_number) {
        $data = DB::table($this->table)
        ->where('classes_id',$classes_id)
        ->where('display_number',$display_number)
        ->value('id');
​
        return $data;
    }
​
​
    /**
    * 新規授業登録処理
    *
    */
    public function InsertNewCurriculum($param) {
        DB::table($this->table)->insert([
            'title'              => $param['title'],
            'video_url'          => $param['video_url'],
            'description'        => $param['description'],
            'classes_id'         => $param['classes_id'],
            'thumbnail'          => $param['thumbnail'],
            'require_flg'        => $param['require_flg'],
            'display_number'     => $param['display_number'],
            'checkbox_name1'     => $param['checkbox_name1'],
            'checkbox_name2'     => $param['checkbox_name2'],
            'checkbox_name3'     => $param['checkbox_name3'],
            'checkbox_name4'     => $param['checkbox_name4'],
            'checkbox_name5'     => $param['checkbox_name5'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
​
    /**
    * オリエン新規登録
    *
    */
    public function InsertNewCurriculumOr($param) {
        DB::table($this->table)->insert([
            'title'              => $param['title'],
            'video_url'          => $param['video_url'],
            'description'        => $param['description'],
            'classes_id'         => $param['classes_id'],
            'thumbnail'          => $param['thumbnail'],
            'display_number'     => $param['display_number'],
            'checkbox_name1'     => NULL,
            'checkbox_name2'     => NULL,
            'checkbox_name3'     => NULL,
            'checkbox_name4'     => NULL,
            'checkbox_name5'     => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
​
    /**
    * チェックボックス初期化処理
    *
    */
    public function deleteCheckboxName($id) {
        DB::table($this->table)
        ->where('id',$id)
        ->update([
            'checkbox_name1'     => NULL,
            'checkbox_name2'     => NULL,
            'checkbox_name3'     => NULL,
            'checkbox_name4'     => NULL,
            'checkbox_name5'     => NULL,
            'updated_at' => Carbon::now()
        ]);
    }
​
    /**
    * サムネ以外授業編集処理
    *
    */
    public function editCurriculumWithoutThumbnail($param) {
        DB::table($this->table)
        ->where('id',$param['id'])
        ->update([
            'title'              => $param['title'],
            'video_url'          => $param['video_url'],
            'description'        => $param['description'],
            'checkbox_name1'     => $param['checkbox_name1'],
            'checkbox_name2'     => $param['checkbox_name2'],
            'checkbox_name3'     => $param['checkbox_name3'],
            'checkbox_name4'     => $param['checkbox_name4'],
            'checkbox_name5'     => $param['checkbox_name5'],
            'updated_at' => Carbon::now()
        ]);
    }
​
    /**
    * サムネ変更あり授業編集処理
    *
    */
    public function editCurriculumWithThumbnail($param) {
        DB::table($this->table)
        ->where('id',$param['id'])
        ->update([
            'title'              => $param['title'],
            'video_url'          => $param['video_url'],
            'description'        => $param['description'],
            'thumbnail'          => $param['thumbnail'],
            'checkbox_name1'     => $param['checkbox_name1'],
            'checkbox_name2'     => $param['checkbox_name2'],
            'checkbox_name3'     => $param['checkbox_name3'],
            'checkbox_name4'     => $param['checkbox_name4'],
            'checkbox_name5'     => $param['checkbox_name5'],
            'updated_at' => Carbon::now()
        ]);
    }
​
    /**
    * サムネ以外授業編集処理
    *
    */
    public function editCurriculumWithoutThumbnailOr($param) {
        DB::table($this->table)
        ->where('id',$param['id'])
        ->update([
            'title'              => $param['title'],
            'video_url'          => $param['video_url'],
            'description'        => $param['description'],
            'checkbox_name1'     => NULL,
            'checkbox_name2'     => NULL,
            'checkbox_name3'     => NULL,
            'checkbox_name4'     => NULL,
            'checkbox_name5'     => NULL,
            'updated_at' => Carbon::now()
        ]);
    }
​
    /**
    * サムネ変更あり授業編集処理
    *
    */
    public function editCurriculumWithThumbnailOr($param) {
        DB::table($this->table)
        ->where('id',$param['id'])
        ->update([
            'title'              => $param['title'],
            'video_url'          => $param['video_url'],
            'description'        => $param['description'],
            'thumbnail'          => $param['thumbnail'],
            'checkbox_name1'     => NULL,
            'checkbox_name2'     => NULL,
            'checkbox_name3'     => NULL,
            'checkbox_name4'     => NULL,
            'checkbox_name5'     => NULL,
            'updated_at' => Carbon::now()
        ]);
    }
​
​
​
​
    /**
    * 次の動画レコードが存在するかチェック処理
    *
    */
    public function getLastCurriculumOfClasses($classes_id,$display_number) {
​
        $data = DB::table($this->table)
        ->where('classes_id',$classes_id)
        ->where('display_number',$display_number)->exists();
        return $data;
    }
​
    /**
    * 対象クラスの情報と授業一覧取得
    *
    */
    public function getClassCurriculums($classes_id) {
        $query = DB::table($this->table)
        ->select()
        ->join('classes','classes.id','=','curriculums.classes_id')
        ->where('classes.id','=',$classes_id)
        ->orderBy('title','asc')
        ->get();
​
        return $query;
    }
    /** 全授業取得
    *
    */
    public function getAll() {
        $query = Curriculum::select()
        ->get();
​
        return $query;
    }
​
​
​
    /**
    * 学級別受講フラグ付き取得
    *
    */
    public function getCurriculumClear($users_id,$classes_id) {
​
        $data = Curriculum::select('curriculums.display_number','curriculums.title','curriculum_progress.clear_flg')
        ->leftJoin('curriculum_progress','curriculum_progress.curriculums_id','=','curriculums.id')
        ->where(function ($query) use($users_id) {
            return $query->where('curriculum_progress.users_id','=',$users_id)
            ->orWhere('curriculum_progress.users_id','=',null);
        })
        ->where('curriculums.classes_id','=',$classes_id)
        ->orderby('curriculums.id')
        ->get();
​
        return $data;
    }
​
    /**
    * 受験に合格した際、次の学級の授業のレコードを取得
    *
    */
    public function getNextCurriculum($classes_id) {
        $query = Curriculum::select()
        ->where('classes_id','=',$classes_id)
        ->where('display_number','=',1)
        ->get();
​
        return $query;
    }
​
    /**
    * classes_id取得
    *
    */
    public function getClassesId($id) {
        $data = DB::table($this->table)
        ->where('id',$id)
        ->value('classes_id');
        return $data;
​
    }
​
​
​
    /**
    * 常時配信切り替え処理
    *
    */
    public function changeAlwaysFlg($flg,$id) {
        DB::table($this->table)
        ->where('id',$id)
        ->update([
            'always_delivery_flg' => $flg,
            'updated_at' => Carbon::now()
        ]);
    }
​
​
    /**
    * 常時配信切り替え処理
    *
    */
    public function getThumbnail($id) {
        $data = DB::table($this->table)
        ->where('id',$id)
        ->value('thumbnail');
​
        return $data;
    }
​
    /**
    * 授業削除
    *
    */
    public function deleteCurriculum($id) {
         DB::table($this->table)
        ->where('id',$id)
        ->delete();
​
        return ;
    }
​
}