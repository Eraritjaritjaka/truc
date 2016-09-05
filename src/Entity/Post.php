<?php

namespace Entity;

/** @Entity(repositoryClass="Repository\PostRepository") @Table(name="Post")*/
class Post {
  	/** @Column(name="id", type="integer") @id @GeneratedValue */
    private $id;
    /** @Column(name="subject", length=250) */
    private $subject;
    /** @Column(name="date", type="datetime") */
    private $date;
    /** @Column(name="message", type="text") */
    private $message;
    /** @ManyToOne(targetEntity="Entity\User")
     *  @JoinColumn(name="author", referencedColumnName="id") */
    private $author;
    /** @OneToMany(targetEntity="Entity\Comment", mappedBy="post", cascade={"persist", "remove"}) */
    private $comment;


    public function getId() {
        return $this->id;
    }

    public function setId($unid) {
        $this->id = $unid;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setSubject($unsubject) {
        $this->subject = $unsubject;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
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

    public function getComment() {
        return $this->comment;
    }

    public function setComment($uncomment) {
        $this->comment = $uncomment;
    }

}
