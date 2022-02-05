<?php 

namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest;
use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Http\Request;

class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $grades = Grade::all();
    return view('pages.Grades.grades', compact('grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(GradeRequest $request)
  {

    // if(Grade::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists())
    //  {
    //    return redirect()->back()->withErrors(__('messages.repeated'));
    //  }
    try{
        $validated = $request->validated();
        $grade = new Grade();
        // $translations = [
        //   'ar' => $request->name_ar,
        //   'en' => $request->name_en,
        //  ];
        // $grade->setTranslations('name', $translations);
    
        $grade->name = ['en' => $request->name_en , 'ar' => $request->name_ar];//translation
        $grade->notes = $request->notes;
        $grade->save();
        toastr()->success(__('messages.success'));
        return redirect()->route('grades.index');
      }
      catch(\Excption $e){
        return redirect()->back()->withError(['error' => $e->getMessage()]);

      }


    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(GradeRequest $request)
  {
    try{
      $validated = $request->validated();
      $grade = Grade::findOrFail($request->id);
      $grade->update(
        [
          $grade->name = ['ar' => $request->name_ar, 'en' => $request->name_en],
          $grade->notes = $request->notes,
        ]);
        toastr()->success(__('messages.update'));
        return redirect()->route('grades.index');
    }
    catch(\Excption $e){
      return redirect()->back()->withError(['error' => $e->getMessage()]);

    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    $class = Classroom::where('grade_id',$request->id)->pluck('grade_id');
    if($class->count() == 0)
    {
      $grade = Grade::findOrFail($request->id);
      $grade->delete();
        toastr()->error(__('messages.delete'));
        return redirect()->route('grades.index');
      }
      else
      {
        toastr()->error(__('grades_trans.delete_grade_error'));
        return redirect()->route('grades.index');
    }
    
  }
  
}

?>