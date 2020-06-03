<?php

namespace App\Service\User;

use App\Entity\CampaignRisk;
use App\Entity\User;
use App\Service\User\Risk\RiskFactory;
use Symfony\Component\HttpFoundation\Request;

class UserService
{
    public function setRole(Request $request, User $user)
    {
        if (isset($request->request->get('user')['admin'])) {
            $user->setRoles(['ROLE_ADMIN']);
        } else {
            $keyRoleAdmin = array_search('ROLE_ADMIN', $user->getRoles());
            $this->deleteRoleAdmin($keyRoleAdmin, $user);
        }
    }

    public function deleteRoleAdmin(string $keyRoleAdmin, User $user)
    {
        if ($keyRoleAdmin !== false || $keyRoleAdmin !== null) {
            $roles = $user->getRoles();
            array_splice($roles, $keyRoleAdmin, 1);
            $user->setRoles($roles);
        }
    }

    public function getRiskResponse(CampaignRisk $data): ?string
    {
        $type = $data->getRisk()->getKey();

        $risk = RiskFactory::getRisk($type);
        $risk->processResponse($data);

        return $risk->getResponse();
    }
}
