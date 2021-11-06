<?php


namespace App\Extensions;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Blog;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

class BlogCollectionExtension implements QueryCollectionExtensionInterface
{
    private $security;
    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(Security $security, RequestStack $requestStack)
    {
        $this->security = $security;
        $this->requestStack = $requestStack;
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        if (Blog::class !== $resourceClass) {
            return;
        }

        if($this->security->isGranted('ROLE_USER')){
            return true;
        }else{
            $rootAlias = $queryBuilder->getRootAliases()[0];
            // $currentTime = date('Y-m-d h:m:s');
            $queryBuilder
                ->where("$rootAlias.schedule IS NULL OR $rootAlias.schedule < CURRENT_DATE()");
            // ->setParameter('currentTime', $currentTime);
        }

    }

}
