<?php

class user_model
{
    public static function addComment($id, $comment, $date, $user)
    {
        $db = Db::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $stmt = $db->prepare("INSERT INTO comment(place_id, value, date, user_id) VALUES (:id, :comment, :date, :user)");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':comment', $comment);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':user', $user);
            $stmt->execute();
        } catch(PDOException $exception) {
            echo $exception;
        }
    }

    public static function getAllCommentsByPlaceID($id)
    {
        $db = Db::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $stmt = $db->prepare("SELECT comment.value, date, user_id FROM comment JOIN place ON place.id = comment.place_id AND place.id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            return $exception;
        }
    }
}