<?php

class C_Page extends C_Base
{
    public function action_index()
    {
        $articles = M_Articles::getInstance();
        $text = $articles->getAll();
        $this->content = $this->template('view/v_view.php', array('text' => $text));
    }

    public function action_edit()
    {
        $this->title .= ' - Редактирование';

        if ($this->isPost()) {
            text_set($_POST['text']);
            header('location: index.php');
            exit();
        }

        $text = text_get();
        $this->content = $this->template('view/v_edit.php', array('text' => $text));
    }

    public function action_view()
    {
        $this->title .= ' - Содержание';

        if ($this->isPost()) {
            text_set($_POST['text']);
            header('location: index.php');
            exit();
        }

        $articles = MArticles::getInstance();
        $text = $articles->getAll();
        $this->content = $this->template('view/v_view.php', array('text' => $text));
    }

    public function action_read()
    {
        $this->title .= ' - Чтение';
        if ($this->isPost()) {
            text_set($_POST['text']);
            header('location: index.php');
            exit();
        }
        $text = select_all_article($_GET['id']);
        $this->content = $this->template('view/v_read.php', array('title' => $text['name_article'], 'text_article' => $text['text_article']));
    }


}
