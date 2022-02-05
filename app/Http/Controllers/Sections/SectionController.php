<?php 

namespace App\Http\Controllers\Sections;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Classes\Classroom;
use App\Models\Section;
use App\Models\Grade;
// use App\Models\Classroom;
use App\Http\Requests\SectionRequest;
use Illuminate\Http\Request;

class SectionController extends Controller 
{

  /**
   * Display a listing of the resource.
   *  
   * @return Response
   */
  public function index()
  {
    $grades = Grade::with(['sections'])->get();
    $list_Grades = Grade::with(['classrooms'])->get();
    return view('pages.Sections.sections', compact('grades','list_Grades'));
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
  public function store(SectionRequest $request)
  {
    try{
      $validated = $request->validated();
      $section = new Section();
      $section->name = ['en' => $request->name_en , 'ar' => $request->name_ar];//translation
      $section->grade_id = $request->grade_id;
      $section->class_id = $request->class_id;
      $section->status = 1 ;
      $section->save();
      toastr()->success(__('messages.success'));
      return redirect()->route('sections.index');
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
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  public function getclasses($id)
  {
      $list_classes = Classroom::where("grade_id", $id)->pluck("name", "id");

      return $list_classes;
  }
  
}

?>