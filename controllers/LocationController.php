<?php
/**
 * Created by PhpStorm.
 * User: Rafe
 * Date: 06/01/2018
 * Time: 15:09
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use app\models\FeedData;
use yii\web\Response;

class LocationController extends ActiveController
{
    public $modelClass = 'app\models\FeedData';

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionLondon(){
        $feed = $this->getFeed();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $feed;
    }

    public function getFeed(){
        //call each feed
        $fourSquare = $this->getFourSquare();
        $viator = $this->getViator();

        $feed_data = [];

        //something to this effect. Make sure the response code is right and something has been returned.
        //each feed will need to be processed differnetly. This could be done with breaking down further

        $fourSquare_data = $this->processFourSquare($fourSquare);
        $viator_data = $this->processViator($viator);

        $feed_data = array_merge($feed_data, $fourSquare_data);
        $feed_data = array_merge($feed_data, $viator_data);

        return $feed_data;
    }

    //curl requests to feed would return a array of objects after decode

    public function getFourSquare(){

        // Get cURL resource
        $curl = curl_init();
// Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://content-api.hiltonapps.com/v1/places/top-places/uk-london-fsq?access_token=jobs383-UgWfVvxQXNhDQLw4v',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
// Send the request & save response to $resp
        $resp = curl_exec($curl);
// Close request to clear up some resources
        curl_close($curl);

        $response = json_decode($resp);

        //code for checking if external feed is broken

        return $response;
    }

    public function getViator(){
        // Get cURL resource
        $curl = curl_init();
// Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://content-api.hiltonapps.com/v1/places/top-places/uk-london-via?access_token=jobs383-UgWfVvxQXNhDQLw4v',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
// Send the request & save response to $resp
        $resp = curl_exec($curl);
// Close request to clear up some resources
        curl_close($curl);

        $response = json_decode($resp);

        //code for checking if external feed is broken

        return $response;
    }

    public function processFourSquare($fourSquare){
        $feed_data = [];
        if(isset($fourSquare->meta->code) and $fourSquare->meta->code == 200){
            foreach($fourSquare->data->locations as $location_data){
                $feed_data[$location_data->name]['name'] = $location_data->name;
                $feed_data[$location_data->name]['description'] = $location_data->category;
                $feed_data[$location_data->name]['map'] = 'somewhere'; //TODO proper map stuff
                $feed_data[$location_data->name]['location_id'] = 1; //TODO set up locations properly eg interface for adding them
                $feed_data[$location_data->name]['provider'] = 'foursquare'; //TODO set up wih model and table for storing providers
                $feed_data[$location_data->name]['link'] = $location_data->link;
            }
        }
        return $feed_data;
    }

    public function processViator($viator){
        $feed_data = [];
        if(isset($viator->meta->code) and $viator->meta->code == 200){
            foreach($viator->data->locations as $location_data){
                $feed_data[$location_data->name]['name'] = $location_data->name;
                $feed_data[$location_data->name]['description'] = $location_data->description;
                $feed_data[$location_data->name]['map'] = 'somewhere'; //TODO proper map stuff
                $feed_data[$location_data->name]['location_id'] = 1; //TODO set up locations properly eg interface for adding them
                $feed_data[$location_data->name]['provider'] = 'viator'; //TODO set up wih model and table for storing providers
                $feed_data[$location_data->name]['link'] = $location_data->link;
            }
        }
        return $feed_data;
    }
}