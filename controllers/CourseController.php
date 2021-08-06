<?php

namespace app\controllers;

use app\models\Course;
use app\models\CoursesCategories;
use app\models\Teacher;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Course::find(),
            'pagination' => [
                'pageSize' => 5
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSearch()
    {
        $select = Yii::$app->request->get('select');
        $search = Yii::$app->request->get('search');

        $dataProvider = new ActiveDataProvider([
            'query' => Course::find()->joinWith(['teacher','category'], true)->where(['like', $select, $search]),
            'pagination' => [
                'pageSize' => 5
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Course model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Course();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $teachers = Teacher::find()->all();
        $freeTeachers = [];
        foreach ($teachers as $teacher)
        {
            if ($teacher->course == NULL){
                $freeTeachers[] = $teacher;
            }
        }
        $teachers = ArrayHelper::map($freeTeachers, 'id', 'name');

        return $this->render('create', [
            'model' => $model,
            'teachers' => $teachers,
        ]);
    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $teachers = $this->getFreeTeachers($id);

        return $this->render('update', [
            'model' => $model,
            'teachers' => $teachers
        ]);
    }

    public function actionAddCategory($id)
    {
        $course = $this->findModel($id);
        $courseCategory = new CoursesCategories();

        $categories = $this->getFreeCategories($id);

        $courseCategory->course_id = $id;
        if ($courseCategory->load(Yii::$app->request->post()) && $courseCategory->save()) {
            return $this->redirect(['view', 'id' => $course->id]);
        }

        return $this->render('add-category', [
            'course' => $course,
            'courseCategory' => $courseCategory,
            'categories' => $categories
        ]);
    }

    public function actionManageCategories($id)
    {
        $course = $this->findModel($id);
        $dataProvider = new ActiveDataProvider([
            'query' => CoursesCategories::find()->where(['course_id' => $id]),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('manage-categories', [
            'dataProvider' => $dataProvider,
            'course' => $course,
        ]);
    }

    public function actionDeleteCategory($course_id, $category_id)
    {
        CoursesCategories::find()->where(['course_id' => $course_id, 'category_id' => $category_id])->one()->delete();

        return $this->redirect(['manage-categories', 'id' => $course_id]);
    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function getFreeCategories($id){
        $categories = (new \yii\db\Query())
            ->select('categories.*')
            ->from('categories')
            ->leftJoin('courses_categories',
                ['categories.id' => new \yii\db\Expression('courses_categories.category_id'), 'courses_categories.course_id' => $id ])
            ->where(['courses_categories.course_id' => null])
            ->all();

        $categories = ArrayHelper::map($categories, 'id', 'name');
        return $categories;
    }

    protected function getFreeTeachers($id){
        $teachers = (new \yii\db\Query())
            ->select('teachers.*')
            ->from('teachers')
            ->leftJoin('courses',
            ['teachers.id' => new \yii\db\Expression('courses.teacher_id')])
            ->where(['courses.id' => null])
            ->all();
        $teachers = ArrayHelper::map($teachers, 'id', 'name');
        return $teachers;
    }


    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
