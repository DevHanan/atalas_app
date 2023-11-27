<?php

namespace App\Http\Controllers\Api\V1;

class Firebase {

    private array $headers = [];
    private array $tokens = [];
    private array $moreData = [];
    private string $authorizationKey;
    private int $type = 1;
    private string $click_action = '';
    private string $title;
    private string $body;
    private bool $isSent = false;


    public function __destruct() {
        if (!$this->isSent) {
            $this->do();
        }
    }

    function do() {
        $fields = [
            'registration_ids' => $this->getTokens(),
            'notification' => [
                'title' => $this->getTitle(),
                'body' => $this->getBody(),
                'type' => $this->getType(),
                'tickerText' => '',
                'vibrate' => 1,
                'sound' => 1,
                'largeIcon' => 'large_icon',
                'smallIcon' => 'small_icon',
                'click_action'=> $this->getClickAction(),
            ]
        ];
        if (count($this->getMoreData())) {
            $fields['data'] = $this->getMoreData();
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        $this->isSent = true;
        return json_decode($result, true);
    }

    /**
     * @param mixed $authorizationKey
     * @return Firebase
     */
    public function setAuthorizationKey($authorizationKey) {
        $this->authorizationKey = $authorizationKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorizationKey() {
        return $this->authorizationKey;
    }

    /**
     * @return array
     */
    public function getHeaders(): array {
        $this->headers[] = 'Authorization: key= ' . $this->getAuthorizationKey();
        $this->headers[] = 'Content-Type: application/json';
        return $this->headers;
    }

    /**
     * @param int $type
     * @return Firebase
     */
    public function setType(int $type): Firebase {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getType(): int {
        return $this->type;
    }

    public function setClickAction(string $click_action): Firebase {
        $this->click_action = $click_action;
        return $this;
    }

    public function getClickAction(): string {
        return $this->click_action;
    }

    /**
     * @param string $title
     * @return Firebase
     */
    public function setTitle(string $title): Firebase {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $body
     * @return Firebase
     */
    public function setBody(string $body): Firebase {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string {
        return $this->body;
    }

    /**
     * @param array $tokens
     * @return Firebase
     */
    public function setTokens(array $tokens): Firebase {
        $this->tokens = $tokens;
        return $this;
    }

    /**
     * @return array
     */
    public function getTokens(): array {
        return $this->tokens;
    }

    /**
     * @param array $moreData
     * @return Firebase
     */
    public function setMoreData(array $moreData): Firebase {
        $this->moreData = $moreData;
        return $this;
    }

    /**
     * @return array
     */
    public function getMoreData(): array {
        return $this->moreData;
    }

}
