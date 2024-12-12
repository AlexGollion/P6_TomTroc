<?php

namespace TomTroc\App\Controller;
use TomTroc\App\Models as Models;
use TomTroc\Services as Services;

class MessagerieController extends AbstractController
{
    public function messagerie() : void
    {
        $this->view('Messagerie', 'messagerie');
    }
    
    public function newMessagerie() : void 
    {
        $idSession = $_SESSION['idUser'];
        $idUserLivre = Services\Utils::request('idUserLivre');

        $messageManager = new Models\MessageManager();
        $idConv = $messageManager->checkIfConvExist($idSession, $idUserLivre);
        
        if ($idConv == -1)
        {
            $userManager = new Models\UserManager();
            $userSession = $userManager->getUserById($idSession);
            $userLivre = $userManager->getUserById($idUserLivre);

            $messageManager->createConversation(array ($userSession, $userLivre));
            $idConv = $messageManager->checkIfConvExist($idSession, $idUserLivre);
        }

        $conversations = $messageManager->getAllConversation($idSession);
        $conv = $messageManager->getConversationById($idConv);

        $this->view('Messagerie', 'messagerie', ["conversations" => $conversations, "selected" => $conv]);
    }

    public function sendMessage() : void
    {
        $userId = $_SESSION['idUser'];
        $idConv = Services\Utils::request('idConversation');
        $content = Services\Utils::request('content');
        $dateCreation = new \DateTime();

        $message = new Models\Message();
        $message->setContent($content);
        $message->setDateCreation($dateCreation);
        $message->setExpediteurId($userId);
        $message->setConversationId($idConv);


        $messageManager = new Models\MessageManager();
        $messageManager->sendMessage($message);

        $conversations = $messageManager->getAllConversation($userId);
        $conv = $messageManager->getConversationById($idConv);

        $this->view('Messagerie', 'messagerie', ["conversations" => $conversations, "selected" => $conv]);
    }
}