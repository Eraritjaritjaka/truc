<?php

namespace Entity;

/** @Entity @Table(name="CommentLike")*/
class CommentLike {

    /** @Column(name="id", type="integer") @id @GeneratedValue */
    private $id;
    /** @ManyToOne(targetEntity="Entity\Comment")
     *  @JoinColumn(name="comment", referencedColumnName="id") */
    private $comment;
    /** @ManyToOne(targetEntity="Entity\User")
     *  @JoinColumn(name="user", referencedColumnName="id") */
    private $user;
    /** @Column(name="score", type="integer") */
    private $score;

    public function getId() {
        return $this->id;
    }

    public function setId($unid) {
        $this->id = $unid;
    }

    public function getComment() {
        return $this->comment;
    }

    public function setComment($uncomment) {
        $this->comment = $uncomment;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($unuser) {
        $this->user = $unuser;
    }

    public function getScore() {
        return $this->score;
    }

    public function setScore($unscore) {
        $this->score = $unscore;
    }

}

?>