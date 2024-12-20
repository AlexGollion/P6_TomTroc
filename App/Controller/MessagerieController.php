<?php

namespace TomTroc\App\Controller;
use TomTroc\App\Models as Models;
use TomTroc\Services as Services;

class MessagerieController extends AbstractController
{
    public function messagerie() : void
    {
        $idSession = $_SESSION['idUser'];
        
        $messageManager = new Models\MessageManager();

        $conversations = $messageManager->getAllConversation($idSession);
        $conv = $conversations[0];

        $this->view('Messagerie', 'messagerie', ["conversations" => $conversations, "selected" => $conv]);
    }
    
    public function newMessagerie() : void 
    {
        $idUserLivre = Services\Utils::request('idUserLivre');
        $idSession = $_SESSION['idUser'];

        if (!isset($idSession))
        {
            header("Location: showConnexion");
            exit();
        }

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

        header("Location: messagerie");
        exit();
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

        header("Location: messagerie");
        exit();
    }
}