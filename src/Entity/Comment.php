<?php

namespace Entity;

/** @Entity @Table(name="Comment")*/
class Comment {
  	/** @Column(name="id", type="integer") @id @GeneratedValue */
    private $id;
    /** @Column(name="date", type="datetime") */
    private $date;
    /** @Column(name="message", type="text") */
    private $message;
    /** @ManyToOne(targetEntity="Entity\User")
     *  @JoinColumn(name="author", referencedColumnName="id") */
    private $author;
	/** @ManyToOne(targetEntity="Entity\Post", inversedBy="comment")
     * @JoinColumn(name="post_id", referencedColumnName="id") */
    private $post;

    public function getId() {
        return $this->id;
    }

    public function setId($unid) {
        $this->id = $unid;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($unedate) {
        $this->date = $unedate;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($unmessage) {
        $this->message = $unmessage;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($unauthor) {
        $this->author = $unauthor;
    }

    public function getPost() {
        return $this->post;
    }

    public function setPost($unpost) {
        $this->post = $unpost;
    }

}
