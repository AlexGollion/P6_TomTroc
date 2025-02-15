<?php

namespace TomTroc\App\Controller;
use TomTroc\App\Models as Models;
use TomTroc\Services as Services;

class MessagerieController extends AbstractController
{
    /**
     * Affiche la messagerie
     * @return void
     */
    public function messagerie() : void
    {
        $idSession = $_SESSION['idUser'];
        $idConv = Services\Utils::request('idConv');
        
        $messageManager = new Models\MessageManager();

        if(isset($idConv))
        {
            $conversations = $messageManager->getAllConversation($idSession, $idConv);
            $messageManager->updateReadMessage($idSession, $idConv);
            $this->view('Messagerie', 'messagerie', ["conversations" => $conversations, "selected" => $idConv]);
        }
        else
        {
            $idLastConv = $messageManager->getLastConversationId($idSession);
            
            if($idLastConv == -1)
            {
                $this->view('Messagerie', 'messagerie', ["conversations" => [], "selected" => $idLastConv]);
            }
            else 
            {
                $conversations = $messageManager->getAllConversation($idSession, $idLastConv);
                $messageManager->updateReadMessage($idSession, $idLastConv);
                $this->view('Messagerie', 'messagerie', ["conversations" => $conversations, "selected" => $idLastConv]);
            }
        }
        
        
    }
    
    /**
     * Créer une nouvelle messagerie et redirige vers la page de messagerie
     * @return void
     */
    public function newMessagerie() : void 
    {
        $idUserLivre = Services\Utils::request('idUserLivre');
        $idSession = $_SESSION['idUser'];

        if ($idSession == $idUserLivre)
        {
            header("Location: messagerie");
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

        header("Location: messagerie&idConv=" . $idConv);
        exit();
    }

    /**
     * Permet d'envoyer un message
     * @return void
     */
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

        Services\Utils::redirect("messagerie", ["idConv" => $idConv]);
    }

    /**
     * Permet d'afficher le nombre de message non lu dans le header
     * @return void
     */
    public function headerMessagerie() : void 
    {
        $userId = $_SESSION['idUser'];
        $messageManager = new Models\MessageManager();
        $nbMessage = $messageManager->headerMessagerie($userId);
        $_SESSION["headerMessagerie"] = $nbMessage;
    }
}