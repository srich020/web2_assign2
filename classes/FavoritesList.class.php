<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FavoritesList
 *
 * @author davidhan02
 */
class FavoritesList {

    protected $favoritePaintings = array();
    protected $favoriteArtists = array();

    public function __construct() {     //Automatic acquisition of painting & artist arrays from session.
        if (isset($_SESSION['favoritePaintings']) && !empty($_SESSION['favoritePaintings'])) {
            $this->favoritePaintings = $_SESSION['favoritePaintings'];
        } else {
            $this->favoritePaintings = array();
            $this->saveFavoritePaintings();
        }

        if (isset($_SESSION['favoriteArtists']) && !empty($_SESSION['favoriteArtists'])) {
            $this->favoriteArtists = $_SESSION['favoriteArtists'];
        } else {
            $this->favoriteArtists = array();
            $this->saveFavoriteArtists();
        }
    }

    public function getFavoritePaintings() {
        return $this->favoritePaintings;
    }

    public function getFavoriteArtists() {
        return $this->favoriteArtists;
    }   

    public function addToFavoritePaintings($painting = array()) {
        if (!is_array($painting) OR count($painting) === 0) { //Empty array?
            return FALSE;
        } else {
            $id = $painting["PaintingID"];

            if (!isset($this->favoritePaintings[$id])) {
                $this->favoritePaintings[$id] = $painting;
            } else {
                //TODO - Notification to tell user that it's already in list 
            }
            $this->saveFavoritePaintings();
        }
    }

    public function addToFavoriteArtists($artists = array()) {
        if (!is_array($artists) OR count($artists) === 0) { 
            return FALSE;
        } else {
            $id = $artists["ArtistID"];

            if (!isset($this->favoriteArtists[$id]) && empty($this->favoriteArtists[$id])) {
                $this->favoriteArtists[$id] = $artists;
            } else {
                //TODO - Notification to tell user that it's already in list 
            }
            $this->saveFavoriteArtists();
        }
    }

    public function deleteFavoritePainting($paintingId) { //Removes a painting from list.
        if (isset($this->favoritePaintings[$paintingId]) && !empty($this->favoritePaintings[$paintingId])) {
            unset($this->favoritePaintings[$paintingId]);
        }
        $this->saveFavoritePaintings();
    }

    public function deleteFavoriteArtist($artistId) { //Removes an artist from list.
        if (isset($this->favoriteArtists[$artistId]) && !empty($this->favoriteArtists[$artistId])) {
            unset($this->favoriteArtists[$artistId]);
        }
        $this->saveFavoriteArtists();
    }

    public function clearAllPaintings() {                //Removes all paintings.
        if (isset($this->favoritePaintings)) {
            $this->favoritePaintings = array();
        }
        saveFavoritePaintings();
    }

    public function clearAllArtists() {                //Removes all paintings.
        if (isset($this->favoriteArtists)) {
            $this->favoriteArtists = array();
        }
        saveFavoriteArtists();
    }

    protected function saveFavoritePaintings() {        //Saves the Paintings list to session.
        $_SESSION['favoritePaintings'] = $this->favoritePaintings;
    }

    protected function saveFavoriteArtists() {           //Saves the Artists list to session.
        $_SESSION['favoriteArtists'] = $this->favoriteArtists;
    }

}
