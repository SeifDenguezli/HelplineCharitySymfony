<?php

namespace App\Controller;
use http\Client\Curl\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Web\WebDriver;
use BotMan\Drivers\Telegram;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
class BoHas extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    /**
     * @Route("/message", name="message" )
     */
    function messageAction(Request $request)
    {
        DriverManager::loadDriver(WebDriver::class);

        // Configuration for the BotMan WebDriver
        $config = [];

        // Create BotMan instance
        $botman = BotManFactory::create($config);

        // Give the bot some things to listen for.
        $botman->hears('(hello|hi|hey)', function (BotMan $bot) {
            $bot->reply('Hello!');
        });

        $botman->hears('(how to donate|donate|pay)', function (BotMan $bot) {
            $bot->typesAndWaits(2);
            $bot->reply('vous pouvez faire un don via http://127.0.0.1:8000/p1/posthome ou bien notre page d\'acceuil ');
        });
        $botman->hears('(suspended|suspendu|ban|banned|toxic|vulgaire)', function (BotMan $bot) {
            $bot->typesAndWaits(3);
            $bot->reply('Si vous etes suspendu a cause d\'utilisation de mot inapproprie veuillez contacter un administrateur ou bien envoyer un mail "helplinecharityconfirm@gmail.com" ');
        });
        $botman->hears('(help|admin|administrateur|admen|owner)', function (BotMan $bot) {
            $bot->typesAndWaits(1);
            $bot->reply('Les administrateurs disponibles pour le moment : Hassan Hochlef ');
            $attachment = new Image('/images/Posts/QSFFQSG.jpg', [
                'custom_payload' => true,
            ]);
            $message = OutgoingMessage::create('Hochlef Hassan - hassan.hochlef@esprit.tn')
                ->withAttachment($attachment);
            $bot->reply($message);
        });
        $botman->hears('(merci|thankyou|thanks|thank you|danke)', function (BotMan $bot) {
            $bot->typesAndWaits(1);
            $bot->reply('Avec plaisir :)');
        });
        // Set a fallback
        $botman->fallback(function (BotMan $bot) {
            $bot->reply('Désolé, mon cerveau est petit pour comprendre ça');
        });

        // Start listening
        $botman->listen();

        return new Response();
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('/posts/index.html.twig');
    }

    /**
     * @Route("/chatframe", name="chatframe")
     */
    public function chatframeAction(Request $request)
    {
        return $this->render('/posts/chat_frame.html.twig');
    }
}