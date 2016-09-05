<?php

namespace Entity;

/** @Entity @Table(name="PostLike")*/
class PostLike {

  	/** @Column(name="id", type="integer") @id @GeneratedValue */
	private $id;
    /** @ManyToOne(targetEntity="Entity\Post")
     *  @JoinColumn(name="post", referencedColumnName="id") */
	private $post;
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

    public function getPost() {
        return $this->post;
    }

    public function setPost($unpost) {
        $this->post = $unpost;
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